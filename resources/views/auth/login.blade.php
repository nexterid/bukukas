@extends ('layouts.login')
@section('content')
	<div class="container h-100">
		<div class="row justify-content-md-center h-100">
			<div class="card-wrapper">
				<div class="brand">
					<img src="{{ asset('assets/img/logo.png') }}">
				</div>
				<div class="card fat">
					<div class="card-body">
						<h4 class="card-title">Login Buku Kas</h4>
						<form method="POST" action="{{ route('login') }}">
                            @csrf
							<div class="form-group">
								<label for="email">Username</label>
								<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Enter Username"  autofocus oninvalid="setCustomValidity('Username tidak boleh kosong !')" oninput="setCustomValidity('')">
								@if ($errors->has('username'))
									<span class="invalid-feedback">
									<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter Password"  data-eye oninvalid="setCustomValidity('Password tidak boleh kosong !')" oninput="setCustomValidity('')">
								@if ($errors->has('password'))
									<span class="invalid-feedback">
									<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label><input type="checkbox" name="remember"> Remember Me</label>
							</div>
							<div class="form-group no-margin">
								<button type="submit" class="btn btn-primary btn-block">
									Login
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="footer">
					DevelopBy &#64; Nexterweb.id 2022
				</div>
			</div>
		</div>
	</div>
@endsection

