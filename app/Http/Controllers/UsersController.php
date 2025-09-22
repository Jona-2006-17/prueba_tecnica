<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnSelf;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\TemplateExport;


use Maatwebsite\Excel\Concerns\FromArray;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'Usuario registrado exitosamente');
    }

    public function edit(User $user_id)
    {
        return view('edit', compact('user_id'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user_id)
    {
        $user_id->delete();
        return redirect()->route('users.index');
    }

    // ==================================================
    // MASS USER CREATION METHODS
    // ==================================================

    public function massCreate()
    {
        return view('users_mass_create');
    }

    
    public function massStore(Request $request)
    {
        $contadorCrear = 0;
        $contadorError = 0;
       
        $validaciones = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone', 'regex:/^[0-9]{10}$/'],
            'dni' => ['required', 'unique:users,dni', 'min:8'],
            'password' => ['required', 'string', 'min:6'],
        ];
        
        foreach ($request->users as $index => $userData) {
            try {
                $validator = Validator::make($userData, $validaciones);
                
                if ($validator->fails()) {
                    $contadorError++;
                    Log::error('Validación fallida en importación', [
                        'fila' => $index + 1,
                        'usuario' => $userData['name'] ?? 'Sin nombre',
                        'errores' => $validator->errors()->toArray(),
                    ]);
                    continue;
                }
                
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'phone' => $userData['phone'],
                    'dni' => $userData['dni'],
                    'password' => $userData['password'],
                ]);
                $contadorCrear++;
                
            } catch (\Exception $e) {
                $contadorError++;
                Log::error('Error de BD en importación', [
                    'fila' => $index + 1,
                    'usuario' => $userData['name'] ?? 'Sin nombre',
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        $message = $contadorError > 0 ? "Creados: {$contadorCrear}, Errores: {$contadorError} (ver logs)" : "Se crearon {$contadorCrear} usuarios exitosamente";
        
        return redirect()->route('users.index')->with('success', $message);
    }

    public function massPreview(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);
        $collection = Excel::toCollection(new UsersImport, $request->file('file'));

        $row2 = $collection->first()->count();
        if($row2 >100){
            return redirect()->route('users.mass-create')->with('file', 'El archivo no debe tener mas de 100 usuarios');
        }
        $rows = $collection->first()->map(function($row) {
            return $row->toArray();
        });

        return view('users_mass_preview', compact('rows'));
    }

    public function csvTemplate(): BinaryFileResponse
    {
        $header = [
            ['name', 'email', 'phone', 'dni', 'password']
        ];

        return Excel::download(new class($header) implements FromArray {
            protected $header;

            public function __construct($header)
            {
                $this->header = $header;
            }

            public function array(): array
            {
                return $this->header;
            }
        }, 'template_usuarios.xlsx');
    }

    // ==================================================
    // MASS USER DELETION METHODS
    // ==================================================

    public function massDelete()
    {
        $users = User::all(); // o filtrar si quieres
        return view('users_mass_delete', compact('users'));
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->ids ?? [];

        // Si subieron archivo
        if ($request->hasFile('file')) {
            $collection = Excel::toCollection(new UsersImport, $request->file('file'));
            $rows = $collection->first()->pluck('id')->toArray(); // asumimos que el archivo tiene columna 'id'
            $ids = array_merge($ids, $rows);
        }

        if (empty($ids)) {
            return redirect()->route('users.mass-delete')->with('error', 'No se seleccionaron usuarios.');
        }

        User::whereIn('id', $ids)->delete();

        return redirect()->route('users.index')->with('success', 'Usuarios eliminados correctamente.');
    }
}
