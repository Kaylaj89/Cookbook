<script>
    function selectAll() {
         var checkboxes = document.getElementsByTagName('input');
         for (i = 0; i < checkboxes.length; i++) { 
             if(checkboxes[i].type == 'checkbox'){
                 checkboxes[i].checked = true;
             }
        }
        document.getElementById('selectall').innerHTML = "<a href='javascript:void(0);'  onclick='unselectAll();'> Unselect All </a>";
       }
   function unselectAll(){
      var checkboxes = document.getElementsByTagName('input');
         for (i = 0; i < checkboxes.length; i++) { 
             if(checkboxes[i].type == 'checkbox'){
                 checkboxes[i].checked = false;
             }
        }
        document.getElementById('selectall').innerHTML = "<a href='javascript:void(0);'  onclick='selectAll();'> Select All </a>";
           }
</script>
<span id="selectall" class="text-indigo-500 hover:text-indigo-700"><a href="javascript:void(0);" onclick="selectAll();">
        Select All </a></span>