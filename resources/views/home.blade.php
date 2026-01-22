<x-layouts.auth-layout>
  <div class="main-card overflow-auto">

    <div class="flex justify-between items-center">
      <h4 class="title-2">Listagem de filas</h4>
      <a href="#" class="btn">
        <i class="far fa-plus me-2"></i>
        Adicionar fila
      </a>
    </div>

    <hr class="mt-2 mb-4">

    @if($queues->count() > 0)
    <table class="" id="tabela">
      <thead class="bg-black text-white">
        <tr>
          <th class="text-xs w-2/14">Nome</th>
          <th class="text-xs w-2/14">Serviço</th>
          <th class="text-xs w-2/14">Balcão</th>
          <th class="text-xs w-1/14 text-center">Estado</th>
          <th class="text-xs w-1/14 text-center">Tickets</th>
          <th class="text-xs w-1/14 text-center">Ignorados</th>
          <th class="text-xs w-1/14 text-center">Não atendidos</th>
          <th class="text-xs w-1/14 text-center">Atendidos</th>
          <th class="text-xs w-1/14 text-center">Em espera</th>
          <th class="w-2/14"></th>
        </tr>
      </thead>
      <tbody>
          @foreach ($queues as $queue)
            <tr>
              <td>{{ $queue->name }}</td>
              <td>{{ $queue->service_name }}</td>
              <td>{{ $queue->service_desk }}</td>
              <td>
                {!! getQueueStatus($queue->status) !!}
              </td>
              <td>{{ $queue->total_tickets }}</td>
              <td>{{ $queue->total_dismissed }}</td>
              <td>{{ $queue->total_not_attended }}</td>
              <td>{{ $queue->total_called }}</td>
              <td>{{ $queue->total_waiting }}</td>
              <td class="flex justify-end gap-2">
                <a href="{{ route('queue.view', ['id' => Crypt::encrypt($queue->id)]) }}" class="text-black" title="Visualizar">
                  <i class="fa fa-eye"></i>
                </a>
                <a href="#" class="text-black" title="Duplicar">
                  <i class="fa fa-copy"></i>
                </a>
                <a href="#" class="text-black" title="Editar">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="text-black" title="Excluir">
                  <i class="fa fa-trash"></i>
                </a>
                
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
    @else
    <div class="text-center">
      <p class="text-gray-500">Nenhuma fila encontrada</p>
    </div>
    @endif
  </div>

  <script>
    $(document).ready(function() {
      $('#tabela').DataTable(
        {
          language: {
            url: "{{ asset('assets/dataTables/pt-BR.json') }}",
          },
        }
      );
    });
  </script>
</x-layouts.auth-layout>