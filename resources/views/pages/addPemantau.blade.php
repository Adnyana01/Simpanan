@extends('../template/index')
@section('content')
<div class="wrap" style="position: relative;">
    <div class="container-fluid selectedSlide dataUsersTabel p-3" >
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title text-dark">Tabel Data Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td class="">Nama</td>
                                <td class="">Email</td>
                                <td class="">Role</td>
                                <td class="">Option</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="">{{ $user->name }}</td>
                                <td class="">{{ $user->email }}</td>
                                <td class="">{{ $user->role }}</td>
                                <td class="">
                                    <a href="updateDataUser{{ $user->id }}">
                                        <img src="{{ asset('asset/img/edit.png') }}" alt="Edit Data" class="menuOption edit" width="25px" id="Data-{{ $user->id }}" style="cursor: pointer;">
                                    </a>
                                    
                                    <a href="deleteDataUser{{ $user->id }}" onclick="return confirm('Hapus?')">
                                        <img src="{{ asset('asset/img/delete.png') }}" alt="Delete Data" class="menuOption delete" width="30px" id="Data-{{ $user->id }}">
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="row justify-content-center bg-dark">
                        <div class="col border border-white rounded t_o_button btn btn-dark m-0" onclick="toggleAnimation({'.addPemantauContainer':['slided','selectedSlide'], '.dataUsersTabel':['selectedSlide', 'slided']})">
                            Tambah Data
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid slided addPemantauContainer">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col bg-light rounded">
        <button class="btn btn-light" onclick="toggleAnimation({'.addPemantauContainer':['selectedSlide','slided'], '.dataUsersTabel':['slided', 'selectedSlide']})">Close Form</button>
            <form action="addUser" method="post">
                @csrf
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Nama User" required>
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="User Email" required>
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="User password" required>
              <label for="role" class="form-label">Role</label>
              <select name="role" class="form-select form-select-lg" id="role">
                <option value="Admin">Admin</option>
                <option value="Pemantau">Pemantau</option>
              </select>
              <div class="d-flex justify-content-center m-3">
                <button type="submit" class="btn btn-dark">Tambah</button>
              </div>
            </form>
        </div>
    </div>
</div>
@if(session('userID'))
@foreach($users->where('id', session('userID')) as $user)
<div class="container-fluid selectedSlide editUserContainer">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col bg-light rounded">
        <button class="btn btn-light" onclick="toggleAnimation({'.editUserContainer':['selectedSlide','slided'], '.dataUsersTabel':['slided', 'selectedSlide']})">Close Form</button>
            <form action="editUser" method="post">
                @csrf
              <input type="hidden" name="id" value="{{ $user->id }}">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" readonly>
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
              <label for="role" class="form-label">Role</label>
              <select name="role" class="form-select form-select-lg" id="role">
                <option value="Admin">Admin</option>
                <option value="Pemantau">Pemantau</option>
              </select>
              <div class="d-flex justify-content-center m-3">
                <button type="submit" class="btn btn-dark">Edit</button>
              </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $('.dataUsersTabel').removeClass('selectedSlide');
    $('.dataUsersTabel').addClass('slided');
</script>
@endforeach
@endif

@if(session('success'))
<div class="infoOrStatus bg-success">
    <div class="massage-box">
        <ul>
        @foreach(session('success') as $msg)
            <li>{{ $msg }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif
@if($errors->any())
<div class="infoOrStatus bg-danger">
    <div class="massage-box">
        <ul>
        @foreach($errors->all() as $msg)
            <li>{{ $msg }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif
@endsection