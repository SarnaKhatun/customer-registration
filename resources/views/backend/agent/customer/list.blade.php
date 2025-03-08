@extends('backend.agent.layouts.master')
@section('title', 'Customer List')
@section('content')
    <style>

        @media only screen and (max-width: 600px) {


            .client {
                flex-direction: column
            }
        }
        table.display.table.table-striped.table-hover thead tr th {
            background: #E2EFDA;
            padding: 10px !important;
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
        }
    </style>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Customer</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between client">
                                <div class="card-title">Customer List</div>
                                <div class="ms-md-auto py-0 py-md-0">
                                    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 d-flex">
                                    <input type="text" id="search_items" class="form-control"
                                           placeholder="Search with Client Id, Name, Phone, NID Number">
                                    <button id="user_items" class="btn-sm btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-search me-2"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Nid Number</th>
                                        <th>School Name</th>
                                        <th>Teacher Name</th>
                                        <th>Vehicle Type</th>
                                        <th>License Number</th>
                                        <th>Status</th>
                                        <th>Approved</th>
                                        <th>Created By</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($customers as $row)
                                        <tr>
                                            <td class="text-end">{{ $loop->iteration }}</td>
                                            <td class="text-end">
                                                @if (isset($row->image))
                                                    <img src="{{ url('backend/images/customer/' . $row->image) }}"
                                                         alt="customer" width="50">
                                                @else
                                                    <img src="{{ url('backend/images/no-image.png') }}" alt="customer"
                                                         width="50">
                                                @endif
                                            </td>
                                            <td class="text-start">{{ $row->name }}</td>
                                            <td class="text-start">
                                               @if($row->type == 'general')
                                                    General
                                                    @elseif($row->type == 'student')
                                                    Student
                                                @elseif($row->type == 'driver')
                                                    Driver
                                                @else
                                                    Agent
                                                   @endif
                                            </td>
                                            <td class="text-start">{{ $row->phone }}</td>
                                            <td class="text-center">{!! $row->address ?? '' !!}</td>
                                            <td class="text-start">{{ $row->nid_number ?? ''}}</td>
                                            <td class="text-start">{{ $row->school_name ?? ''}}</td>
                                            <td class="text-start">{{ $row->teacher_name ?? ''}}</td>
                                            <td class="text-start">{{ $row->vehicle_type ?? ''}}</td>
                                            <td class="text-start">{{ $row->license_number ?? ''}}</td>
                                            <td class="text-center">
                                                {{ $row->status == 1 ? 'Active' : 'Inactive'}}
                                            </td>
                                            <td class="text-center">
                                                {{ $row->approved == 1 ? 'Approved' : 'Not Approved'}}
                                            </td>
                                            <td class="text-center">{{ $row->addBY->name ?? ''}}</td>
                                            <td class="text-end">
                                                <a href="{{ route('customers.edit', $row->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('customers.destroy', $row->id) }}" method="POST"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this?');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user_items').click(function(e) {
                e.preventDefault();
                var searchItems = $('#search_items').val();
                window.location.href = "{{ route('users.index') }}?search_items=" + searchItems;
            });
        });
    </script>
@endpush
