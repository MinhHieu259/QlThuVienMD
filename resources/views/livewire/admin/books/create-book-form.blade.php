<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Books</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Books</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="createBook" action="">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputYearPublisher" class="col-form-label">Year Publisher</label>
                                            <input wire:model.defer="state.year_publisher" type="text" class="form-control @error('year_publisher') is-invalid @enderror" id="inputYearPublisher" placeholder="Year Publisher">
                                            @error('year_publisher')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category:</label>
                                            <select class="form-control select2bs4 @error('category_id') is-invalid @enderror"  style="width: 100%;"
                                                    wire:model.defer="state.category_id">
                                                <option>Select Category Book</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name   }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Author:</label>
                                            <select class="form-control select2bs4 @error('author_id') is-invalid @enderror"  style="width: 100%;"
                                                    wire:model.defer="state.author_id">
                                                <option>Select Author Book</option>
                                                @foreach($authors as $author)
                                                    <option value="{{$author->id}}">{{$author->name   }}</option>
                                                @endforeach
                                            </select>
                                            @error('author_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Publisher:</label>
                                            <select class="form-control select2bs4 @error('publisher_id') is-invalid @enderror"  style="width: 100%;"
                                                    wire:model.defer="state.publisher_id">
                                                <option>Select Publisher Book</option>
                                                @foreach($publishers as $publisher)
                                                    <option value="{{$publisher->id}}">{{$publisher->name   }}</option>
                                                @endforeach
                                            </select>
                                            @error('publisher_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div wire:ignore class="form-group">
                                            <label>Note:</label>
                                            <div class="input-group date">
                                                <textarea id="note" type="text" data-note="@this"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customFile">Profile Photo</label>
                                            <div class="custom-file">
                                                <div x-data="{ isUploading: false, progress: 5 }"
                                                     x-on:livewire-upload-start="isUploading = true"
                                                     x-on:livewire-upload-finish="isUploading = false; progress = 5"
                                                     x-on:livewire-upload-error="isUploading = false"
                                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded ">
                                                        <div class="progress-bar bg-primary progress-bar-striped"
                                                             role="progressbar"
                                                             aria-valuenow="40"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             x-bind:style="`width:${progress}%`">
                                                            <span class="sr-only">40% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="custom-file-label" for="customFile">
                                                    @if($photo)
                                                        {{$photo->getClientOriginalName()}}
                                                    @else
                                                        Choose file
                                                    @endif
                                                </label>
                                                {{-- load image--}}
                                                <br>
                                                @if ($photo)
                                                    <img src="{{ $photo->temporaryUrl() }}" width="50" height="50" style="object-fit: cover"
                                                         class="img">
                                                @else
                                                    <img src="{{ $state['avatar_url'] ?? '' }}"
                                                         class="img">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="">
                            <a href="{{route('admin.book.list')}}" class="btn btn-secondary" ><i
                                    class="fa fa-times mr-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"> Save</i>
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#note'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        let note = $('#note').data('note');
                        eval(note).set('state.note', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush

    @push('styles')
        <style>
            .custom-error .select2-selection {
                border:none;
            }
        </style>
    @endpush
</div>
