@extends('layouts.appA')

@section('title', 'Donador')

@section('content')

        <form action="" method="post">
                <input type="search" name="texto" id="buscar">
        </form>
        <div id="resultado">
        
        </div>
        
        <script>
                window.addEventListener("load", function() {
                        buscar.addEventListener("keyup",(e)=>(
                                fetch(`/buscador`,{
                                        method:'post',
                                        body:JSON.stringify({texto : buscar.value}),
                                        headers:{
                                                "Content-type":"aplication/json",
                                                "X-Requested-With":"XMLHttpRequest",
                                                "X-CSRF-Token":document.head.querySelector("[name~=csrf-token][content]").content
                                        }
                                })
                                .then(reponse=>{
                                        return response.json()
                                })
                                .then(data=>{
                                        console.log(data)
                                })
                        ))
                })
        </script>
@endsection