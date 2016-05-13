<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>InspirerBlog - AdminPanel</title>
    <link href="{{ elixir('assets/common/css/app.css') }}" rel="stylesheet">
    <link href="{{ elixir('assets/inspirer-blog/admin/css/login.css') }}" rel="stylesheet">
</head>
<body>
<div class="admin-gate">
    <div class="row border-reset">
        <div class="col-md-6 border-reset">
            <div class="login-bg"></div>
        </div>
        <div class="col-md-6 border-reset login-container">
            <form action="{{ route('inspirer-blog.admin.login') }}" method="post" class="form-inline">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Input your username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Input your password" id="password" class="form-control">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>