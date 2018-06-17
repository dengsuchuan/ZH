<?php /*a:1:{s:62:"D:\WebServer\www\tp5.1\application/index/view\demo7\test2.html";i:1525106242;}*/ ?>

<?php echo htmlentities($username); ?><br>
<?php echo htmlentities($password); ?><br>
<?php echo htmlentities($age); ?><br>

<hr>

<?php echo htmlentities($goods['name']); ?><br>
<?php echo htmlentities($goods['model']); ?><br>
<?php echo htmlentities($goods['price']); ?><br>

<hr>

<?php echo htmlentities($info->course); ?><br>
<?php echo htmlentities($info->lecture); ?><br>
<hr>

<?php echo htmlentities(SITE_NAME); ?><br>
<hr>

<?php echo htmlentities(PHP_VERSION); ?><br>
<?php echo htmlentities(PHP_OS); ?><br>
<hr>

<?php echo htmlentities(app('request')->server('PHP_SELF')); ?><br>
<hr>

<?php echo htmlentities(app('config')->get('database.hostname')); ?><br>

<?php echo htmlentities(app('request')->get('name')); ?><br>
<?php echo htmlentities(app('request')->param('name')); ?><br>
<?php echo htmlentities(app('request')->path()); ?><br>
<?php echo htmlentities(app('request')->root()); ?><br>
<?php echo htmlentities(app('request')->root(true)); ?><br>
<?php echo htmlentities(app('request')->controller()); ?><br>
<?php echo htmlentities(app('request')->action()); ?><br>
<?php echo htmlentities(app('request')->host()); ?><br>
<?php echo htmlentities(app('request')->ip()); ?><br>
