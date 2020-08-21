@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Change Password') }}</div>

              <div class="card-body">

                <form action="{{ route('password.edit') }}" method="post">
                  @csrf
                  @method('PATCH')
                  
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" name="old_password" required>

                    @error('old_password')
                      <small>{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>

                    @error('password')
                      <small>{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>

                    @error('password_confirmation')
                      <small>{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <button type="submit" class="form-control btn btn-dark">
                      Submit
                    </button>
                  </div>

                </form>

              </div>
          </div>
      </div>
  </div>
</div>
@endsection