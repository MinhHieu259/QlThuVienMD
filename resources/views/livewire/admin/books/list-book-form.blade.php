<div>
{{--    <x-loading-indicator/>--}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Book</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Book</li>
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
                            <a href="{{route('admin.book.create')}}">
                                <button class="btn btn-primary">Add New Books</button>
                            </a>
                        @if($selectedRows)
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-default">Bulk Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">Delete
                                            Selected</a>
                                    </div>
                                </div>

                                <span class="ml-2">selected {{count($selectedRows)}} {{Str::plural('book', count($selectedRows))}}</span>
                            @endif

                        </div>
                        <div>
                            <select class="form-control select2bs4 " style="width: 100%;" wire:model="searchAuthor" wire:target="searchAuthor">
                                <option value>Select Authors Name</option>
                                @foreach($authors as $author)
                                    <option value="{{$author->_id}}">{{$author->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-inputs.select3 wire:model="searchCategories" id="searchCategories" placeholder="Select Category Book">
                            @foreach($categories as $category)
                                <option value="{{$category->_id}}">{{$category->name}}</option>
                            @endforeach
                        </x-inputs.select3>

                        <x-search-input wire:model="searchTerm"/>



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
                                    <th>Image</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Publisher Name</th>
                                    <th scope="col">Category Book</th>
                                    <th scope="col">Author Name</th>
                                    <th scope="col">Year Publisher</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($books as $index=>$book)
                                    <tr>
                                        <th>
                                            <div class="icheck-primary d-inline ml-2">
                                                <input wire:model="selectedRows" type="checkbox"
                                                       value="{{$book->id}}" name="ids"
                                                       id="{{$book->id}}">
                                                <label for="{{$book->id}}"></label>
                                            </div>
                                        </th>
                                        <th scope="row">{{$books->firstItem() + $index }}</th>
                                        <th>
                                            <img src="{{$book->image_url}}"  width="70" height="70" alt="" style="object-fit: cover">
                                        </th>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->publisher->name }}</td>
                                        <td>{{ $book->category->name }}</td>
                                        <td>{{ $book->author->name }}</td>
                                        <td>{{ $book->year_publisher }}</td>
                                        <td>
                                            <a href="{{ route('admin.book.edit', $book) }}">
                                                <i class="fa fa-edit "></i>
                                            </a>
                                            <a href="" wire:click.prevent="confirmBookRemoval('{{$book->_id}}')">
                                                <i class="fa fa-trash text-danger"></i>
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
                            {{ $books ->links() }}
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
