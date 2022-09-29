@extends('layout')

@section('content')

    <h1 class="text-center text-2xl pt-4 uppercase font-bold">List of todolist</h1>
    
    <form action="/?page={{ request()->query('page') }}" class="w-1/2 mx-auto relative mt-8" method="post">
        @csrf
        <input type="text" placeholder="Type something!!" class="p-2 bg-indigo-800 w-full 
        placeholder:italic rounded outline-none text-white" name="des">
       
        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400 absolute top-2 right-2 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>

       
    </form>
    <form action="/delete" method="get">
        <button class="float-right bg-green-700 rounded px-2 py-2 mt-2 text-white" id="submitbtn" type="submit">Save</button>
        <input type="hidden" name="ids[]" value="1" id="ids">
    </form>
    <br>
    <hr class="mt-8 mb-2 w-2/3 mx-auto">

    <div class="todoitems w-2/3 mx-auto">
        @forelse ($paginate as $todoitem)
        
        <div class="bg-gray-400 p-2 rounded flex gap-3 mb-2 {{ $todoitem->is_done == 1 ? 'checked' : '' }}"" id="todoitem">
            <input type="checkbox" {{ $todoitem->is_done == 1 ? 'checked' : '' }} value="{{ $todoitem->id }}">
            <p>{{ $todoitem->des }}</p>

        </div>
        @empty
            <h1 class="text-2xl text-center font-bold">There are no item</h1>
        @endforelse

        
        <div class="flex justify-center mt-10">
            {{ $paginate->links() }}

        </div>
        {{-- @if(count($todolist) >8)
        <div class="mt-12">
         
            @for ($x = 1;$x<=ceil(count($todolist)/8); $x++)
                <a href="/{{ $x }}" class="px-4 py-2 bg-indigo-800 text-white rounded-sm
                cursor-pointer">{{ $x }}</a>
            @endfor
         
        </div>
        @endif --}}
    </div>

    <script>

        // document.getElementsByTagName('form')[0].addEventListener('submit',function(e)=>{
        //     e.preventDefault();
        // });
        

        let todoitems = document.querySelectorAll('#todoitem');
        let submitBtn = document.getElementById('submitbtn');
        let ids = [];

        for(let x = 0;x<todoitems.length;x++){
            todoitems[x].firstElementChild.addEventListener('change',function(e){
              
                for(let i = 0;i<todoitems[x].children.length;i++){
                    todoitems[x].children[i].className= "";
                    }
                todoitems[x].classList.toggle('checked');
                
                if(e.target.checked){
                    ids.push(e.target.value)
                }
               
            });
        }
        submitBtn.addEventListener('click',function(e){
            // e.preventDefault();

            let uniqueIds = [...new Set(ids)];
            let listofid = document.getElementById('ids');

            listofid.value = uniqueIds;
        })

        
    </script>

   

@endsection