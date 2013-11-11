<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="/js/altadmin/jstree/jquery.cookie.js"></script>
<script src="/js/altadmin/jstree/jquery.hotkeys.js"></script>
<script src="/js/altadmin/jstree/jquery.jstree.js"></script>



<link rel="stylesheet" href="/js/altadmin/jstree/themes/classic/style.css" type="text/css" media="screen" />
<!--<link rel="stylesheet" href="/js/altadmin/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css" type="text/css" media="screen" />-->



<script>
    $(function() {
        $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                Ok: function() {
                    $(this).dialog( "close" );
                }
            }
        });
    });
  
  
    function clickPage(id) {
        alert(id);
    }
</script>

<!--
 Nested Set Admin GUI
 Main View File  index.php

 @author Spiros Kabasakalis <kabasakalis@gmail.com>,myspace.com/spiroskabasakalis
 @copyright Copyright &copy; 2011 Spiros Kabasakalis
 @since 1.0
 @license The MIT License-->
<?php
/* @var $this NewsController */

$this->breadcrumbs = array(
    'Дерево страниц',
);
?>
<article class="module width_full">
    <header><h3>Дерево страниц</h3></header>
    <div class="module_content">
    </div>



    <!--The tree will be rendered in this div-->

    <div id="<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>" >

    </div>

    <script  type="text/javascript">
        $(function () {
            $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>")
            .bind("before.jstree", function (e, data) {
                $("#alog").append(data.func + "<br />");
            })
            .jstree({
                    
                    
                "html_data" : {
                    "ajax" : {
                        "type":"POST",
                        "url" : "<?php echo $baseUrl; ?>/altadmin/pages/fetchTree",
                        "data" : function (n) {
                            return {
                                id : n.attr ? n.attr("id") : 0,
                                "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                            };
                        }
                    }
                },

                "contextmenu":  { 'items': {

                        "rename" : {
                            "label" : "Переименовать",
                            "action" : function (obj) { this.rename(obj); }
                        },
                        "update" : {
                            "label"	: "Редактировать",
                            "action"	: function (obj) {
                                window.location = "/altadmin/pages/edit/"+obj.attr("id").replace("node_","");
                                return true;
                                id=obj.attr("id").replace("node_","");
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo $baseUrl; ?>/altadmin/pages/returnForm",
                                    data:{
                                        'update_id':  id,
                                        "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                    },
                                    'beforeSend' : function(){
                                        $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                    },
                                    'complete' : function(){
                                        $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                    },
                                    success: function(data){

                                        $.fancybox(data,
                                        {    "transitionIn"	:	"elastic",
                                            "transitionOut"    :      "elastic",
                                            "speedIn"		:	600,
                                            "speedOut"		:	200,
                                            "overlayShow"	:	false,
                                            "hideOnContentClick": false,
                                            "onClosed":    function(){
                                            } //onclosed function
                                        })//fancybox

                                    } //success
                                });//ajax

                            }//action function

                        },//update

                        /*"properties" : {
            "label"	: "Properties",
            "action" : function (obj) {
                                       id=obj.attr("id").replace("node_","")
                                 $.ajax({
                                       type:"POST",
                                       url:"<?php echo $baseUrl; ?>/altadmin/pages/returnView",
                                       data:   {
                                                 "id" :id,
                                                "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                                  },
                                     beforeSend : function(){
                                                   $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                                                   },
                                    complete : function(){
                                                  $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                                                 },
                                   success :  function(data){
                            $.fancybox(data,
                            {    "transitionIn"	:	"elastic",
                                "transitionOut"    :      "elastic",
                                 "speedIn"		:	600,
                                "speedOut"		:	200,
                                "overlayShow"	:	false,
                                "hideOnContentClick": false,
                                 "onClosed":    function(){
                                                                           } //onclosed function
                            })//fancybox

                        } //function



                    });//ajax

                                                    },
            "_class"			: "class",	// class is applied to the item LI node
            "separator_before"	: false,	// Insert a separator before the item
            "separator_after"	: true	// Insert a separator after the item

            },//properties
                         */
                        "remove" : {
                            
                            "label"	: "Удалить",
                            "action" : function (obj) {
                                    //$('#myModal').modal({'show':true}),
                                    
                                $(
    '<div id="dialog-message" title="Удалить страницу">'+
      '<p><span style="color:#FF73B4;font-weight:bold;">'+(obj).attr('rel')+'</span>, точно удалить?</p>'+
    '</div>'
)
                                  .dialog({
                                      resizable: false,
                                      height:170,
                                      modal: true,
                                      buttons: {
                                          "Да": function() {
                                              jQuery("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").jstree("remove",obj);
                                              $( this ).dialog( "close" );
                                          },
                                          "Нет": function() {
                                              $( this ).dialog( "close" );
                                          }
                                      }
                                  });

                              }
                          },//remove
                          "create" : {
                              "label"	: "Создать",
                              "action" : function (obj) { this.create(obj); },
                              "separator_after": false
                          },

                          
                      }//items
                  },//context menu

                  // the `plugins` array allows you to configure the active plugins on this instance
                  //"plugins" : ["themes","html_data","cookies","contextmenu","crrm","dnd"],
                  //
                  "plugins" : ["themes","html_data","ui","crrm","cookies","dnd","search","types","hotkeys","contextmenu"],
                  // each plugin you have included can have its own config object
                  "core" : { "initially_open" : [ <?php echo $open_nodes ?> ],'open_parents':true}
                  // it makes sense to configure a plugin only if overriding the defaults

              })

              ///EVENTS
              .bind("rename.jstree", function (e, data) {
                  $.ajax({
                      type:"POST",
                      url:"<?php echo $baseUrl; ?>/altadmin/pages/rename",
                      data:  {
                          "id" : data.rslt.obj.attr("id").replace("node_",""),
                          "new_name" : data.rslt.new_name,
                          "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                      },
                      beforeSend : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                      },
                      complete : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                      },
                      success:function (r) {  response= $.parseJSON(r);
                          if(!response.success) {
                              $.jstree.rollback(data.rlbk);
                          }else{
                              data.rslt.obj.attr("rel",data.rslt.new_name);
                          };
                      }
                  });
              })

              .bind("remove.jstree", function (e, data) {
                  $.ajax({
                      type:"POST",
                      url:"<?php echo $baseUrl; ?>/altadmin/pages/remove",
                      data:{
                          "id" : data.rslt.obj.attr("id").replace("node_",""),
                          "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                      },
                      beforeSend : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                      },
                      complete: function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                      },
                      success:function (r) {  response= $.parseJSON(r);
                          if(!response.success) {
                              $.jstree.rollback(data.rlbk);
                          };
                      }
                  });
              })

              .bind("create.jstree", function (e, data) {
                  newname=data.rslt.name;
                  parent_id=data.rslt.parent.attr("id").replace("node_","");
                  $.ajax({
                      type: "POST",
                      url: "<?php echo $baseUrl; ?>/altadmin/pages/returnForm",
                      data:{   'name': newname,
                          'parent_id':   parent_id,
                          "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                      },
                      beforeSend : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                      },
                      complete : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                      },
                      success: function(data){
                          ddd=$.parseJSON(data);
					

                          window.location = "/altadmin/pages/edit/"+ddd.id;

                          /*$.fancybox(data,
                            {    "transitionIn"	:	"elastic",
                                "transitionOut"    :      "elastic",
                                 "speedIn"		:	600,
                                "speedOut"		:	200,
                                "overlayShow"	:	false,
                                "hideOnContentClick": false,
                                 "onClosed":    function(){
                                                                           } //onclosed function
                            })*///fancybox

                      } //success
                  });//ajax

              })
              .bind("move_node.jstree", function (e, data) {
                  data.rslt.o.each(function (i) {

                      //jstree provides a whole  bunch of properties for the move_node event
                      //not all are needed for this view,but they are there if you need them.
                      //Commented out logs  are for debugging and exploration of jstree.

                      next= jQuery.jstree._reference('#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>')._get_next (this, true);
                      previous= jQuery.jstree._reference('#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>')._get_prev(this,true);

                      pos=data.rslt.cp;
                      moved_node=$(this).attr('id').replace("node_","");
                      next_node=next!=false?$(next).attr('id').replace("node_",""):false;
                      previous_node= previous!=false?$(previous).attr('id').replace("node_",""):false;
                      new_parent=$(data.rslt.np).attr('id').replace("node_","");
                      old_parent=$(data.rslt.op).attr('id').replace("node_","");
                      ref_node=$(data.rslt.r).attr('id').replace("node_","");
                      ot=data.rslt.ot;
                      rt=data.rslt.rt;
                      copy= typeof data.rslt.cy!='undefined'?data.rslt.cy:false;
                      copied_node= (typeof $(data.rslt.oc).attr('id') !='undefined')? $(data.rslt.oc).attr('id').replace("node_",""):'UNDEFINED';
                      new_parent_root=data.rslt.cr!=-1?$(data.rslt.cr).attr('id').replace("node_",""):'root';
                      replaced_node= (typeof $(data.rslt.or).attr('id') !='undefined')? $(data.rslt.or).attr('id').replace("node_",""):'UNDEFINED';


                      //                      console.log(data.rslt);
                      //                      console.log(pos,'POS');
                      //                      console.log(previous_node,'PREVIOUS NODE');
                      //                      console.log(moved_node,'MOVED_NODE');
                      //                      console.log(next_node,'NEXT_NODE');
                      //                      console.log(new_parent,'NEW PARENT');
                      //                      console.log(old_parent,'OLD PARENT');
                      //                      console.log(ref_node,'REFERENCE NODE');
                      //                      console.log(ot,'ORIGINAL TREE');
                      //                      console.log(rt,'REFERENCE TREE');
                      //                      console.log(copy,'IS IT A COPY');
                      //                      console.log( copied_node,'COPIED NODE');
                      //                      console.log( new_parent_root,'NEW PARENT INCLUDING ROOT');
                      //                      console.log(replaced_node,'REPLACED NODE');


                      $.ajax({
                          async : false,
                          type: 'POST',
                          url: "<?php echo $baseUrl; ?>/altadmin/pages/moveCopy",

                          data : {
                              "moved_node" : moved_node,
                              "new_parent":new_parent,
                              "new_parent_root":new_parent_root,
                              "old_parent":old_parent,
                              "pos" : pos,
                              "previous_node":previous_node,
                              "next_node":next_node,
                              "copy" : copy,
                              "copied_node":copied_node,
                              "replaced_node":replaced_node,
                              "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                          },
                          beforeSend : function(){
                              $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                          },
                          complete : function(){
                              $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                          },
                          success : function (r) {
                              response=$.parseJSON(r);
                              if(!response.success) {
                                  $.jstree.rollback(data.rlbk);
                                  alert(response.message);
                              }
                              else { 
                                  //if it's a copy
                                  if  (data.rslt.cy){
                                      $(data.rslt.oc).attr("id", "node_" + response.id);                         
                                      if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
                                          data.inst.refresh(data.inst._get_parent(data.rslt.oc));
                                      }
                                  }
                                  //  console.log('OK');
                              }

                          }
                      }); //ajax



                  });//each function
              });   //bind move event

              ;//JSTREE FINALLY ENDS (PHEW!)

              //BINDING EVENTS FOR THE ADD ROOT AND REFRESH BUTTONS.
              $("#add_root").click(function () {
                  $.ajax({
                      type: 'POST',
                      url:"<?php echo $baseUrl; ?>/altadmin/pages/returnForm",
                      data:	{
                          "create_root" : true,
                          "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                      },
                      beforeSend : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                      },
                      complete : function(){
                          $("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                      },
                      success:    function(data){

                          $.fancybox(data,
                          {    "transitionIn"	:	"elastic",
                              "transitionOut"    :      "elastic",
                              "speedIn"		:	600,
                              "speedOut"		:	200,
                              "overlayShow"	:	false,
                              "hideOnContentClick": false,
                              "onClosed":    function(){
                              } //onclosed function
                          })//fancybox

                      } //function

                  });//post
              });//click function

              $("#reload").click(function () {
                  jQuery("#<?php echo Pages::ADMIN_TREE_CONTAINER_ID; ?>").jstree("refresh");
              });
          });

    </script>

    <footer>
        <div class="submit_link">

        </div>
    </footer>
</article><!-- end of post new article -->
 <!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Modal header</h3>
</div>
<div class="modal-body">
<p>One fine body…</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary">Save changes</button>
</div>
</div>