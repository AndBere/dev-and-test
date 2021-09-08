<head>
    
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">

</head>

<body>
    

<div class="contaiter">
    <button style="margin:1rem;"><a href="{{ route('albums.create') }}"> + Создать </a></button>

    <div class="card-body">
        <h5>Таблица I</h5>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">
                       ID
                    </th>
                    <th>
                       Photos array
                    </th>
                    <th>
                        Created_at
                    </th>
                    <th>
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $album)
                <tr>
                    <td>{{ $album->id }}</td>
                    <td>{{ Arr::query($album->images) }}</td>
                    <td>{{ $album->created_at }}</td>
                    <td><a href="{{ route('albums.edit',$album->id) }}" class="text-primary mx-2">
                        <i class="far fa-edit"></i>
                    </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>