@extends('layouts.emails')
@section('content')
    <!-- content -->
    <div class="content">
        <table bgcolor="">
            <tr>
                <td>
                    <h4>Hello
                        <small>{{ $school_name }}</small>
                    </h4>
                </td>
            </tr>
        </table>
    </div>
    <!-- /content -->
    <!-- content -->
    <div class="content">
        <table bgcolor="">
            <tr>
                <td>
                    <p class="">To Activate Your School Admin Panel Please Click The Button Below</p>
                    <a class="btn" href="{{ $link }}">Click To Activate &raquo;</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- /content -->
    <!-- content -->
    <div class="content">
        <table bgcolor="">
            <tr>
                <td>
                    <!-- Callout Panel -->
                    <p class="callout">
                        If the above button do not work , please copy and paste this URL in browser.
                        <br>
                        <span style="color: red">{{ $link }}</span>
                    </p>
                    <!-- /callout panel -->
                </td>
            </tr>
        </table>
    </div>
    <!-- /content -->
@stop