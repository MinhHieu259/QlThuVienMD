<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Appointments</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="">Borrow Book</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="updateBorrow" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Borrow</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="book">Book:</label>
                                            <select wire:model.defer="state.book_id"
                                                    class="form-control @error('book_id') is-invalid @enderror">
                                                <option>---Select Book---</option>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->_id }}">{{ $book->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('book_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <div>
                                                <input type="number" wire:model.defer="state.quantity"
                                                       class="form-control @error('quantity') is-invalid @enderror"
                                                       id="inputQuantity" placeholder="Input Quantity">
                                                @error('quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentDate">Borrow Date</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="state.borrowing_day" id="borrowDate"
                                                              :error="'date_borrow'"/>
                                                @error('borrowing_day')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentTime">Borrow Time</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-timepicker wire:model.defer="state.borrowing_time" id="borrowTime"
                                                              :error="'borrow_time'"/>
                                                @error('borrowing_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentDate">Return Date</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="state.return_day" id="returnDate"
                                                              :error="'return_day'"/>
                                                @error('return_day')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentTime">Return Time</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-timepicker wire:model.defer="state.return_time" id="returnTime"
                                                              :error="'return_time'"/>
                                                @error('return_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div wire:ignore class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea wire:model.defer="state.note" id="note" data-note="@this"
                                                      class="form-control">{!! $state['note'] !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Status:</label>
                                            <select wire:model.defer="state.status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                <option value="">--- Select Status ---</option>
                                                <option value="BORROWING">Borrowing</option>
                                                <option value="RETURN">Return</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('admin.borrow.list')}}">
                                    <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i>
                                        Cancel
                                    </button>
                                </a>
                                <button id="submit" type="submit" class="btn btn-primary"><i
                                        class="fa fa-save mr-1"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('livewire/admin/borrow-book/borrow-css')
@include('livewire/admin/borrow-book/borrow-js')

