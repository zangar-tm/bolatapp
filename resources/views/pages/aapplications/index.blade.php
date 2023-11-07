@extends('layout.app')
@section('title','Заявки')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
      <section class="tables">
        <div class="title">
          <h2>Заявки</h2>
        </div>
        <div class="tables-wrapper">
          <table class="tables-item">
            <thead class="tables-head">
              <tr class="tables-item-row">
                <th class="th-max-100"><span>ID</span></th>
                <th><span>Экспедитор</span></th>
                <th><span>Дата</span></th>
                <th><span class="text-transparent">btns</span></th>
              </tr>
            </thead>
            <tbody class="tables-body">
            @foreach($applications as $application)
              <tr class="tables-item-row">
                <td class="td-max-100"><a class="tables-link tables-id" href="/aapplications/{{$application->id}}">{{$application->id}}</a></td>
                <td><a class="tables-link" href="/aapplications/{{$application->id}}">{{$application->user->name}}</a></td>
                <td><a class="tables-link" href="/aapplications/{{$application->id}}">{{$application->created_at->format('d.m.Y')}}</a></td>
                <td>
                  <div class="btns-group">
                    <a class="btn-edit" href="/aapplications/{{$application->id}}/edit">
                      <svg class="inline-block"
                        xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" width="24"
                        height="24" role="presentation">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>
</div>
@endsection

@section('scripts')
  <script>
      document.addEventListener('DOMContentLoaded', function () {
      const deleteLinks = document.querySelectorAll('.btn-delete');

      deleteLinks.forEach(link => {
          link.addEventListener('click', function (event) {
              event.preventDefault();
              const userId = this.href.split('/').pop();
              fetch(`/aapplications/${userId}`, {
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                      'Content-Type': 'application/json', 
                  },
              });
              window.location.reload();
          });
      });
  });
</script>
@endsection