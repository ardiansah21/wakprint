{{-- <form action="{{ route('store') }}" method="POST"> --}}
    <div class="form-group">
        <label>Kategori</label>
        {!! Form::select('id_kategori', $kategori,null,['class'=>'form-control','placeholder' => '- pilih kategori -']) !!}
        {{-- <select type="text" name="id_kategori" class="form-control">
           <option value="- pilih kategori -">- pilih kategori -</option>
           <option value="{{ $kategori->id_kategori }}">- pilih kategori -</option>
       </select> --}}
       </div>
       <div class="form-group">
        <label>Tanggal</label>
        {{-- <input type="date" name="tanggal" class="form-control"> --}}
        {{ Form::date('tanggal', null, ['class'=>'form-control'])  }}
       </div>
       <div class="form-group">
        <label>Judul</label>
        {{-- <input type="text" name="judul" class="form-control"> --}}
        {!! Form::text('judul',null,['class'=>'form-control']); !!}
       </div>
       <div class="form-group">
        <label>Isi</label>
        {{-- <textarea name="isi" id="isi" cols="40" rows="2" class="form-control"></textarea> --}}
        {!! Form::textarea('isi',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
       </div>
       <div class="form-group">
        <label>Status</label>
        <div class="radio">
         <label>
             {{-- <input type="radio" name="status" id="status" value="1"> --}}
             {!! Form::radio('status', '1') !!}
             Aktif
           </label>
        </div>
        <div class="radio">
         <label>
           {{-- <input type="radio" name="status" id="status" value="0"> --}}
             {!! Form::radio('status', '0') !!}
             Non Aktif
           </label>
        </div>
       </div>
       {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
       {!! Form::submit('Simpan',['class'=>'btn btn-success']); !!}
{{-- </form> --}}
