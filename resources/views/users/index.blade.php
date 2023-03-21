@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4>Users
                    <button type="button" class="btn btn-xs btn-primary float-right add">Add user</button>
                </h4>
                <hr>


                <div class="card">
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered  table-striped ">
                            <thead>
                                <tr>
                                    <th>{{ __(' Name') }}</th>
                                    <th>{{ __(' Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Date Of Birth') }}</th>
                                    <th>{{ __('Gender') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="form" action="" method="POST" id="addUs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-top: 35px">

                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Male"
                                            checked>
                                        <span class="form-check-label"> Male </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Female">
                                        <span class="form-check-label"> Female</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Country</label>
                                    <select name="country" class="form-control" name="country">
                                        <option value=""> Choose...</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Nepal" selected>Nepal</option>
                                        <option value=""India>India</option>
                                        <option value="Afganistan">Afganistan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Mobile Number</label>
                                    <input type="text" name="phone" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Date Of Birth</label>
                                    <input type="date" name="dob" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="bio">About Yourself</label>
                                    <textarea name="bio" id="bio" class="form-control input-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                        <button type="button" class="btn btn-primary btn-update">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('post_script')
        <script src="{{ asset('front/js/custom.js') }}"></script>
    @endpush
@endsection
