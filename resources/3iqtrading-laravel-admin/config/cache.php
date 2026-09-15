<?php
return ['default'=>env('CACHE_STORE','database'),'stores'=>['array'=>['driver'=>'array','serialize'=>false],'file'=>['driver'=>'file','path'=>storage_path('framework/cache/data')],'database'=>['driver'=>'database','connection'=>env('DB_CACHE_CONNECTION'),'table'=>env('DB_CACHE_TABLE','cache')],'null'=>['driver'=>'null']],'prefix'=>env('CACHE_PREFIX','3iqtrading_cache')];
