 <?php
 
 
 function notify ($title,$text)
  {
  echo " <script> 
        var unique_id = $.gritter.add({
            title: '".$title."',
            text: '".$text."',
            image: 'notification/img/moreNoti.jpg',
            sticky: true,
            time: '',
            class_name: 'my-sticky-class'
        }); 
	</script>
	";
  }
  ?>