@extends('app')

@section('content')
    {!! Form::label('pais', 'Pais:') !!}
    {!! Form::select('pais', $paises) !!}

    {!! Form::label('cidade', 'Cidades:') !!}
    {!! Form::select('cidade', []) !!}
@endsection

@section('post-script')
    <script type="text/javascript">
        $('select[name=pais]').change(function () {
            var idPais = $(this).val();

            $.get('/get-cidades/' + idPais, function (cidades) {
                $('select[name=cidade]').empty();
                $.each(cidades, function (key, value) {
                    $('select[name=cidade]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });
    </script>
@endsection