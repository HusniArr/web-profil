@extends('backend.layout')
@section('content')
<!-- page header -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
	<a href="{{ route('blogs')}}" class="btn btn-sm btn-dark d-sm-inline-block rounded">
		<i class="fas fa-arrow-left"></i> Kembali
	</a>
</div>

<div class="row">
	<div class="col-xl-8 col-md-12">
		<!-- tampilkan pesan berhasil jika sudah dimasukan dengan benar -->
		@if($message = session('success'))
			<x-alert type="success" :message="$message"/>
		@endif

		<div class="card">
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					@csrf
					<div class="mb-3 form-group">
						<label for="title">Judul</label>
						<input type="text" class="form-control @error('title') @enderror" name="title" id="title" value="{{ old('title',$blog->judul) }}">
						@error('title')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</div>
					<div class="mb-3 form-group">
						<label for="content">Konten</label>
						<textarea name="content" id="content" rows="5" class="form-control @error('content') @enderror">{{ old('content',$blog->ket)}}</textarea>
						@error('content')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</div>
					<div class="mb-3 form-group">
						<label for="category">Kategori</label>
						<select name="category" id="category" class="form-control @error('category') @enderror">
							<option value="">Choose Category</option>
							@foreach($categories as $item)
								<option value="{{$item->id}}" @if($item->id == $blog->id_kategori) selected @endif>{{$item->kategori}}</option>
							@endforeach
						</select>
							@error('category')
							<span class="text-danger">{{$message}}</span>
							@enderror
					</div>
					<div class="mb-3 form-group">
						<label for="tags">Tags</label>
						<select multiple="multiple" name="tags[]" id="tags" class="form-control">
							<option value="">Choose Tags</option>
							@foreach($tags as $item)
							<option value="{{$item->tag}}">{{ $item->tag }}</option>
							@endforeach
						</select>
						@error('tags')
						<span class="text-dannger">{{$message}}</span>
						@enderror
					</div>
					<div class="mb-3 form-group">
						<label for="img_file">Upload Gambar</label>
						<input type="file" class="form-control @error('img_file') @enderror" value="" >
						@error('img_file')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</div>
					<div class="mb-3">
						<button class="btn btn-sm btn-primary rounded"><i class="fas fa-save fa-fw"></i>Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>

    $(document).ready(function(){
        <!-- select 2 multiple -->
        $('#category').select2({
            placeholder:"Select",
            allowClear:true
        });
        $('#tags').select2({
            placeholder:"Select",
            allowClear:true
        });
    })
</script>

@endsection