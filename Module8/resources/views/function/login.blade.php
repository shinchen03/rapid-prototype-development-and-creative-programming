@extends('layouts.main')

@section('content')
    <div class="container">
    <div class = "row">
        <div class = "col-md-12">
            <h1>Contact Us</h1>
                <hr>
                <form>
                    <div class="form-group">Please login here</div>
                    <div class="form-group">
                        <label name="username">Username:</label>
                        <input id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="subject">Password:</label>
                            <input id="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Login" class="btn-primary"> &nbsp
                    <input type="submit" value="Register" class="btn-primary">
                </form>
        </div>
    </div>
    </div>