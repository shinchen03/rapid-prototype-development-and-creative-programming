@extends('layouts.master')

@section('content')
     <br><br><br><br>
    <div class="container">
    <div class = "row">
        <div class = "col-md-12">
            <h2>Contact Us</h2>
                <hr>
                <form>
                    <div class="form-group">
                        <label name="email">Email</label>
                        <input id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="subject">Subject:</label>
                            <input id="subject" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="message">Message:</label>
                        <textarea id="message" name="message" class="form-control">Type your message here...</textarea>
                    </div>
                    <input type="submit" value="Send Message" class="btn-success">
                </form>
        </div>
    </div>
    </div>