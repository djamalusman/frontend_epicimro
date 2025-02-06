<div class="card">
    <div class="card-body">
        <h4 class="card-title">Reset Password</h4>
        
        <!-- Menampilkan pesan error atau sukses -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
