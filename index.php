<?php
require('lib/latte/src/latte.php');
require('lib/mongo-php/src/mongo.php');
require('classes/get.php');
require('classes/put.php');
require('classes/render.php');

//classes
$render = new Render();
$get = new Get();
$put = new Put();

//libs
$latte = new Latte\Engine;
$latte->setTempDirectory('temp/cache/latte');

//navigace - parser parametru
$p=explode('/',$_GET['action']);
$params=array(
    'operation'=>(isset($p[0])?$p[0]:null),
    'id'=>(isset($p[1])?$p[1]:null),
    'action'=>(isset($p[2])?$p[2]:null)
);

//transformace chmod
if(isset($_POST['permissions']['chmod'])){
    $_POST['permissions']['chmod']=implode($_POST['permissions']['chmod']);
}


switch($params['operation']){
    case 'structure':
        if(sizeof($_POST)>0){
            print_r($put->structure($_POST));
        }
    
        //načtení info o struktuře
        $structure=$get->structure($params['id']);
        if(isset($structure[0])){
            $data=['structure'=>$structure[0],'equipment'=>$get->equipment(null,$params['id'])];
            $onload='unRoll("'.$params['id'].'");';
        }
    break;

    case 'edit-structure':
        //načtení info o struktuře
        $structure=$get->structure($params['id']);
    
        if(isset($structure[0])){
            $permissions=[
                $render->chmodOptions($structure[0]->permissions->chmod,0),
                $render->chmodOptions($structure[0]->permissions->chmod,1),
                $render->chmodOptions($structure[0]->permissions->chmod,2)
            ];
            $data=['structure'=>$structure[0],'permissions'=>$permissions];
        }
    break;

    case 'add-structure':
        $params['operation']='edit-structure';
        $permissions=[
                $render->chmodOptions('764',0),
                $render->chmodOptions('764',1),
                $render->chmodOptions('764',2)
            ];
        $data=['structure'=>(object)['parent'=>$params['id']],'permissions'=>$permissions];
        
    break;
    
    case 'add-equipment':
        $params['operation']='edit-equipment';
        $permissions=[
                $render->chmodOptions('764',0),
                $render->chmodOptions('764',1),
                $render->chmodOptions('764',2)
            ];
        $data=['structure-id'=>$params['id'],'permissions'=>$permissions];
    break;

    case 'add-function':
        $params['operation']='edit-function';
        $data=['structure-id'=>$params['id']];
    break;

    default:
        $params['operation']='widgets';
        $data=[];
    break;
}

if($params['action']=='ajax'){
    $latte->render('templates/'.$params['operation'].'.latte',$data);
}else{
    $latte->render(
        'templates/index.latte',[
        'content'=> $latte->renderToString('templates/'.$params['operation'].'.latte',$data),
        'tree'=>$render->strom(),
        'onload'=>$onload
        ]
    );
}
