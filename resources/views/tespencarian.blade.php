@extends('layouts.member')

@section('content')
    <input type="search" name="keyword" id="keyword">
<button id="b"> TEKAN</button>

@endsection

@section('script')
<script>
    $(document).ready(function (){
        $('#b').on('click',function(){
            var xhr = new XMLHttpRequest();
            var url = "{{route("pencariantes")}}";
            // alert(url);
            var data = JSON.stringify({
                keyword : "asdasdasd"
            });

            xhr.onloadstart = function (){
                $('.produk').css('color', '#dfecf6');
                $('.produk').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/img/loading.gif" />');
            }

            xhr.onloadend = function () {
                if (this.responseText !== "") {
                    var data = JSON.parse(this.responseText);

                    var name = document.createElement("h3");
                    name.innerHTML = data;

                }
            }
            xhr.open("GET", url, true);
            xhr.send(data);
        });
    });

</script>
@endsection
