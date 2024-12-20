@extends('admin.main')
@push('title')
    <title>Terms and Condition</title>
@endpush
@section('main-section')

    <div class="pagetitle">
      <h1>Terms and Condition</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Pages</a></li>
          <li class="breadcrumb-item active">Terms and Condition Edit</li>
        </ol>
      </nav>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <form action="{{ route('terms-and-condition-update', ['id' => $data->id]) }}" method="post">
                @csrf
                <textarea class="tinymce-editor" name="content">
                  {{ $data->content }}
                </textarea>

                <div class="mx-auto text-center">
                  <input type="submit" value="Update" class="btn btn-primary w-50 mt-3 text-center">
                </div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section>
@endsection
