<div>
    {{--    <x-loading-indicator/>--}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Borrow</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Borrow</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle mr-1"></i></strong> {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a href="{{route('admin.borrow.add')}}">
                                <button class="btn btn-primary">Add New Borrow</button>
                            </a>
                            @if($selectedRows)
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-default">Bulk Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a wire:click.prevent="markAllAsBorrowing" class="dropdown-item"
                                           href="#">Mark as Borrowing</a>
                                        <a wire:click.prevent="markAllAsReturned" class="dropdown-item"
                                           href="#">Mask as Returned</a>
                                    </div>
                                </div>

                                <span class="ml-2">selected {{count($selectedRows)}} {{Str::plural('borrow', count($selectedRows))}}</span>
                            @endif

                        </div>
                        <div>
                            <select class="form-control select2bs4 " style="width: 100%;" wire:model="status" wire:target="status">
                                <option value>----- Select Status -----</option>
                                <option value="BORROWING">Borrowing</option>
                                <option value="RETURN">Return</option>
                            </select>
                        </div>

                        <x-inputs.select4 wire:model="searchUserName" id="searchUserName" placeholder="Select Username">
                            @foreach($users as $user)
                                <option value="{{$user->_id}}">{{$user->name}}</option>
                            @endforeach
                        </x-inputs.select4>

                        <x-search-input wire:model="searchTerm" placeholder="Input Day Borrow"/>



                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="icheck-primary d-inline ml-2">
                                            <input wire:model="selectPageRows" type="checkbox" value="" name="todo1"
                                                   id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">User Borrow</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Borrow Date</th>
                                    <th scope="col">Borrow Time</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Return Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($borrows as $index => $borrow)
                                    <tr>
                                        <th>
                                            <div class="icheck-primary d-inline ml-2">
                                                <input wire:model="selectedRows" type="checkbox"
                                                       value="{{$borrow->id}}" name="ids"
                                                       id="{{$borrow->id}}">
                                                <label for="{{$borrow->id}}"></label>
                                            </div>
                                        </th>
                                        <th scope="row">{{$borrows->firstItem() + $index }}</th>
                                        <td>{{ $borrow->book->name }}</td>
                                        <td>{{ $borrow->user->name }}</td>
                                        <td>{{ $borrow->quantity }}</td>
                                        <td>{{ $borrow->borrowing_day }}</td>
                                        <td>{{ $borrow->borrowing_time }}</td>
                                        <td>{{ $borrow->return_day ?? 'Not Return' }}</td>
                                        <td>{{ $borrow->return_time ?? 'Not Return' }}</td>
                                        <td>{{ $borrow->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.borrow.edit', $borrow) }}">
                                                <i class="fa fa-edit "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="9">
                                            <img src="{{asset('unDraw/undraw_engineering_team_a7n2.svg')}}" alt="No results found" width="25%">
                                            <p class="mt-2">No results found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $borrows ->links() }}
                        </div>
                    </div>


                </div>
                <!-- /.col-md-6 -->

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal -->
    <x-confirmation-alert/>
</div>
