@extends('emails._layouts.main')

@section('content')
<table>
    <th></th>
    <tr>
        <td>
            Hello, {{ Str::title($user->name) }}!
        </td>
    </tr>
    <tr>
        <td>
            Thank you for joining us. We're glad to have you on board.
        </td>
    </tr>
    <tr>
        <td>
            <b>Login Credentials:</b>
        </td>
    </tr>
    <tr>
        <td>
            <div><b>Email Address:</b> {{ $user->email }}</div>
            <div><b>Password:</b> {{ $password }}</div>
        </td>
    </tr>
    <tr>
        <td>
            <b>NOTE:</b> Change your temporary password upon your first login and do not share your credentials.
        </td>
    </tr>
    <tr>
        <td>
            If you have any inquiries, please feel free to contact us through (+63) 47 111 2222 / (+63) 916 999 5555 or info@blog.stis
        </td>
    </tr>
    <tr>
        <td>
            Regards, <br /> BLOG Team
        </td>
    </tr>
    <tfoot>
        <td>
            &copy; {{ date('Y') }} BLOG. All Rights Reserved.
        </td>
    </tfoot>
</table>
@stop
