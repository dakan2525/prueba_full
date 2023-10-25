<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>panel usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-5 justify-content-end"><a class="btn btn-danger col-md-2" href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Cerrar
                Sesion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">lista de usuarios</h5>
                    </div>
                    <div class="card-body">
                        <table id="tableUser" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($users as $user)
                                    @if ($user->id !== Auth::user()->id)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status === 'Activo')
                                                    <a href="{{ route('change-status', $user->id) }}"
                                                        class="badge bg-success">Activo</a>
                                                @else
                                                    <a href="{{ route('change-status', $user->id) }}"
                                                        class="badge bg-danger">Inactivo</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a class="btn btn-primary fw-semibold"
                                                    href="{{ route('users.edit', ['user' => $user]) }}">Editar</a>

                                                <button type="button" class="btn btn-danger fw-semibold"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal-{{ $user->id }}">Eliminar</button>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="confirmModal-{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="confirmModalLabel">
                                                            Eliminar
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Seguro que desea eliminar este usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form class="m-1"
                                                            action="{{ route('users.destroy', $user) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="reset" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Cancelar</button>

                                                            <button type="submit"
                                                                class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Crear usuarios</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                    name="name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    name="email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirme la contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                let table = new DataTable('#tableUser');
            </script>
            @if (Session::get('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: "¡Bien!",
                        text: '{{ Session::get('success') }}',
                        custonClass: {
                            confirmButton: 'btn btn-success'
                        },
                        timer: 2500
                    });
                </script>
            @endif
            @if (Session::get('fail'))
                <script>
                    Swal.fire({
                        icon: 'Error',
                        title: "¡Error!",
                        text: '{{ Session::get('fail') }}',
                        custonClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        timer: 2500

                    });
                </script>
            @endif
</body>

</html>
