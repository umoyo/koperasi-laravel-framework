@extends('layouts.appAdmin')
@section('content')


<div class="container-fluid halaman-konten">
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6 text-right">
            Identitas
        </div>
      </div>
   </div>
<div class="card-body">

    <div id="notifications"></div>  
    {!! Form::model( $identitas ,['method' => 'PATCH','url'=>['nasabah/'.$identitas->id_enc]  ,'files' => 'true','enctype'=>'multipart/form-data']) !!}
    @csrf

    <input type="hidden" name="method" value="put" id="method" >
    <div class="form-group" >
    {!! Form::label( 'jenis_tabungan', 'Jenis Tabungan:') !!}
    {{Form::select ('jenis_tabungan', ['sekarela' => 'sukarela', 'bambu' => 'bambu', 'tanah_liat' => 'tanah liat'], null , ['id'=>'jenis_kelamin','class'=>'form-control form-control-sm']) }}
    </div>

    <div class="form-group" >
    {!! Form::label('nama', 'Nama Lengkap:') !!}
    {!! Form::text('nama_lengkap',null,['class'=>'form-control form-control-sm','id'=>'nama_lengkap', 'maxlength'=>50 ,'required']) !!} <div style="font-size:8pt;margin-left:5px">max 50</div>
    </div>

    <div class="form-group" >
    {!! Form::label( 'jenis_kelamin', 'Jenis Kelamin:') !!}
    {{Form::select ('jenis_kelamin', ['','laki-laki' => 'laki-laki', 'perempuan' => 'perempuan'], null , ['value'=> $identitas->jenis_kelamin ,'class'=>'form-control form-control-sm' ,'required' ] ) }}
    </div>

        <div class="row">
        <div class="col-sm-4" >
            {!! Form::label('tempat_lahir', 'Tempat:') !!}
            {!! Form::text('tempat_lahir',null,['id'=>'tempat_lahir','class'=>'form-control form-control-sm','maxlength'=>18,'required']) !!}
            <div style="font-size:8pt;margin-left:5px">max 30</div>
        </div>

        <div class="col-sm-8" >
            {!! Form::label('tanggal_lahir', 'Tanggal Lahir (HH/BB/TTTT) :') !!}
            <div class="input-group input-append date" >
                <input type="date" id="tanggal_lahir" value="{{$identitas->tanggal_lahir}}" name="tanggal_lahir" min="1000-01-01"   max="3000-12-31" class="form-control form-control-sm" required>
                <span class="input-group-addon add-on">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        </div>

    <div class="form-group" style="margin-top:10px" >
    {!! Form::label('alamat', 'Alamat lengkap:') !!}
    {!! Form::textarea('alamat',null,['id'=>'alamat','height'=>'50%','class'=>'form-control form-control-sm','maxlength'=>500,'required']) !!}
        <div style="font-size:8pt;margin-left:5px">max 200</div>
    </div>

    <div class="row">
        <div class="col-sm-3 form-group" >
        {!! Form::label('provinsi', 'Provinsi:') !!}
        <select name="provinsi_asal" id="provinsi_asal" value="{{$identitas->provinsi_asal}}" class="form-control form-control-sm" required>
            <option value="{{$identitas->provinsi_asal}}">{{$identitas->nama_provinsi_asal}}</option>
            @foreach ($provinsi as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        </div>

        <div class="col-sm-3 form-group" >
        {!! Form::label('kabupaten', 'Kab / Kota:') !!}
        {{ Form::select ('kabupaten_asal', [$identitas->kabupaten_asal => $identitas->nama_kabupaten_asal], $identitas->kabupaten_asal , ['id'=>'kabupaten_asal','class'=>'form-control form-control-sm','required']) }}
        </div>

        <div class="col-sm-3 form-group" >
        {!! Form::label('kecamatan', 'Kecamatan:') !!}
        {{ Form::select ('kecamatan_asal', [$identitas->kecamatan_asal => $identitas->nama_kecamatan_asal], null , ['id'=>'kecamatan_asal','class'=>'form-control form-control-sm','required']) }}
        </div>

        <div class="col-sm-3 form-group" >
        {!! Form::label('kelurahan', 'Kelurahan:') !!}
        {{ Form::select ('kelurahan_asal', [$identitas->kelurahan_asal => $identitas->nama_kelurahan_asal], null , ['id'=>'kelurahan_asal','class'=>'form-control form-control-sm','required']) }}
        </div>
    </div>

    <div class="form-group" id="telp">
    {!! Form::label('telp', 'No. telpon Rumah:') !!}
    {!! Form::text('telp',null,['class'=>'form-control form-control-sm','id'=>'telephone', 'maxlength'=>50  ]) !!} 
        <div style="font-size:8pt;margin-left:5px">max 15</div>
    </div>

    <div class="form-group" id="hp">
    {!! Form::label('hp', 'No. hp:') !!}
    {!! Form::text('hp',null,['class'=>'form-control form-control-sm','id'=>'handphone', 'maxlength'=>50 ,'required' ]) !!} 
        <div style="font-size:8pt;margin-left:5px">max 15</div>
    </div>


    <div class="form-group">
    {!! Form::submit('Simpan', ['id'=>'ganti_identitas','class' => 'btn btn-primary form-control']) !!}
    {!! Form::close() !!}
    </div>

</div>
</div>
</div>


<script type="text/javascript">

	$(document).ready(function(){
		$('#provinsi').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();
      		$.ajax({
            	type : 'GET',
           		url : window.location.origin + '/kabupaten',
            	data :  
              'prov_id=' + prov,
             
				success: function (data) 
				{	
					$("#kabupaten").html(data);
				}
          	});
		});
	});

</script>



<!-- KOTA alamat -->


<script type="text/javascript">
    $(document).ready(function() {
       
 $('select[name="provinsi_asal"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: window.location.origin + '/identitas/kabupaten/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kabupaten_asal"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kabupaten_asal"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="kabupaten_asal" disable]').empty();

            }
        });

    });
</script>


<!-- KOTA ALAMAT -->

<script type="text/javascript">
    $(document).ready(function() {
       
 $('select[name="kabupaten_asal"]').on('change', function() {
            var state2ID = $(this).val();
            if(state2ID) {
                $.ajax({
                    url: window.location.origin + '/identitas/kecamatan/'+state2ID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {       
                        $('select[name="kecamatan_asal"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan_asal"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="kecamatan_asal" disable]').empty();
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       
 $('select[name="kecamatan_asal"]').on('change', function() {
            var state3ID = $(this).val();
            if(state3ID) {
                $.ajax({
                    url: window.location.origin + '/identitas/kelurahan/'+state3ID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {               
                        $('select[name="kelurahan_asal"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kelurahan_asal"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="kelurahan_asal"]').empty();
            }
        });

    });
</script>


@endsection