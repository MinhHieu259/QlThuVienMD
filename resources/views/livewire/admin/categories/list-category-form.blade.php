<div>
{{--    <x-loading-indicator/>--}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Categories</li>
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
                            <a href="{{route('admin.category.create')}}">
                                <button class="btn btn-primary">Add New Category</button>
                            </a>

                        </div>

                        <x-search-input wire:model="searchTerm"/>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Name Author</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $index=>$category)
                                    <tr>
                                        <th scope="row">{{$categories->firstItem() + $index }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category) }}">
                                                <i class="fa fa-edit "></i>
                                            </a>
                                            <a href="" wire:click.prevent="confirmCategoryRemoval('{{$category->_id}}')">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            <img src="{{asset('unDraw/undraw_engineering_team_a7n2.svg')}}" alt="No results found" width="25%">
                                            <p class="mt-2">No results found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $categories ->links() }}
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
