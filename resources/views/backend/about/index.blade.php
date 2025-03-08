@extends('backend.layouts.master')
@section('title', 'About us')
@section('content')
    <style>
        .form-check,
        .form-group {
            padding: 0;
        }

        .select2-container--default .select2-selection--single {
            border: 2px solid #ebedf2;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            top: 70%;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }
    </style>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4>About us</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="card-title">Edit About us</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('about-us.update', $about->id) }}" method="POST">
                                @csrf
                                <div class="row g-2">
                                    <!-- Title -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="title">Title<span style="color: red"></span></label>
                                            <input type="text" name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title', $about->title ?? '') }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email<span style="color: red"></span></label>
                                            <input type="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $about->email ?? '') }}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="phone">Phone<span style="color: red">*</span></label>
                                            <input type="number" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone', $about->phone ?? '') }}">
                                            @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="website">Website<span style="color: red"></span></label>
                                            <input type="text" name="website"
                                                   class="form-control @error('website') is-invalid @enderror"
                                                   value="{{ old('website', $about->website ?? '') }}">
                                            @error('website')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="facebook">Facebook<span style="color: red"></span></label>
                                            <input type="text" name="facebook"
                                                   class="form-control @error('facebook') is-invalid @enderror"
                                                   value="{{ old('facebook', $about->facebook ?? '') }}">
                                            @error('facebook')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="whatsapp_contact">WhatsApp Contact<span style="color: red"></span></label>
                                            <input type="text" name="whatsapp_contact"
                                                   class="form-control @error('whatsapp_contact') is-invalid @enderror"
                                                   value="{{ old('whatsapp_contact', $about->whatsapp_contact ?? '') }}">
                                            @error('whatsapp_contact')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="short_description">Description<span style="color: red">*</span></label>
                                            <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" id="" cols="30" rows="10">{!! $about->short_description !!}</textarea>
                                            @error('short_description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


