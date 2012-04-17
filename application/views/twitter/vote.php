<html>
<head>
    <script language="JavaScript">
    function refreshParent() {
      if (window.opener){
        window.opener.<?=$call;?>;
      }
     window.close();
    }
    refreshParent();
    </script>
</head>
<body>
    
</body>
</html>