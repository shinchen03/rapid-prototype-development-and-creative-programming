@extends ('layouts.master')

@section('content')
    <div class="col-sm-8">
        
        <h1>Register</h1>
        
        <form>
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
                
             <div class="form-group">
                <label for="email">Email:</label>
                <input type=email"" id="email" name="email" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            
            <input type="submit" value="Login" class="btn-primary"> &nbsp
            <input type="submit" value="Register" class="btn-primary">
        </form>
    </div>
@endsection