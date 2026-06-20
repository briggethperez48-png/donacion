<table>
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th>
                REPORTE DE USUARIOS
            </th>
        </tr>
        <tr>
            <th>ID</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Área</th>
                <th>Fecha de Alta</th>
                <th>Teléfono</th>
                <th>Estatus</th>
                <th>Email</th>
                <th>Responsable</th>
                <th>Fecha de Registro</th>
        </tr>
    </thead>
    <tbody>
         @foreach($users as $user)
                @php 
                        $nomCom = $user->nombre . ' ' . $user->apPaterno . ' ' . $user->apMaterno;
                @endphp
                <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>{{ $nomCom }}</td>
                        <td>{{ $user->relacionArea->area ?? 'Sin Área' }}</td>
                        <td>{{ $user->fechaAlta }}</td>
                        <td>{{ $user->telefono }}</td>
                        <td>
                            {{ $user->trashed() ? 'INACTIVO' : 'ACTIVO' }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->administrador->nombre ?? '-' }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                </tr>
        @endforeach
    </tbody>
</table>