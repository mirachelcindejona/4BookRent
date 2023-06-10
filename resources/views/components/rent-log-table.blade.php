<div>
    <table class="table table-bordered table-hover text-center align-middle">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">User</th>
                <th scope="col">Book</th>
                <th scope="col">Rent Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->username }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->rent_date }}</td>
                <td>{{ $item->return_date }}</td>
                <td class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-danger' : 'text-success') }}">{{ $item->actual_return_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>