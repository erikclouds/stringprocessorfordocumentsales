
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style_button.css">
</head>
<body>
<form action="insert.php" method="POST">
<textarea id="demo" name="demo"></textarea>
<textarea style="display:none;" id="demo2" name="demo2"></textarea>
<input type="hidden" id="text_2" name="text_2">
<input type="text"  id="demo3" name="kd_outlet"></input>
<input type="text"  id="demo4" name="FKMLG"></input>
<input type="text"  id="demo5"></input>
<input type="text"  id="cobaan" name="cobaan"></input>
<input type="text"  id="FRMLG" name="FRMLG"></input>
<textarea style="display:none;" id="tanggal" name="text_1"></textarea>
<button type="submit" class="btn_proses" onclick="getData()" name="klik" >Convert</button>
<button type="submit" class="btn_proses" >To Do</button>
<script type="text/javascript" src="data.js"></script>
<script type="text/javascript">
 const copyintoTextarea = 'document.getElementById("demo2").value';
function getData() {
 let fakturArray = [];
 const alfabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
 let sourceData = document.getElementById("demo").value;
 var kata = document.getElementById("demo").value;
 for (let d = 0; d <= 1000; d++) {
    sourceData = sourceData.replace(" SBF-", "\nSBF-");
    sourceData = sourceData.replace(" CFL-", "\nCFL-");
  }
 for (let i = 0; i <= principal.length; i++) {
    sourceData = sourceData.replace(principal[i], "");
  }
   for (let i = 0; i <= otherArray.length; i++) {
    sourceData = sourceData.replace(otherArray[i], "");
  }
  bln = 0;
  tgl = 0;
  for (var ulang = 0; ulang <= 51; ulang++) {
      for (var bln = 1; bln <= 12; bln++) {
        for (var tgl = 1; tgl <= 31; tgl++) {
          if (bln >= 10) {
            if (tgl >= 10) {
            tanggal = tgl + "-" + bln + "-" + "2020 ";
            sourceData = sourceData.replace(tanggal, "");
            document.getElementById("demo2").value = sourceData;
            }else if (tgl < 10) {
            tanggal = "0" + tgl + "-" + bln + "-" + "2020 ";
            sourceData = sourceData.replace(tanggal, "");
            document.getElementById("demo2").value = sourceData;
            }
          }else if (bln < 10) {
            if (tgl >= 10) {
            tanggal = tgl + "-0" + bln + "-" + "2020 ";
            sourceData = sourceData.replace(tanggal, "");
            document.getElementById("demo2").value = sourceData;
            }else if (tgl < 10) {
            tanggal = "0" + tgl + "-0" + bln + "-" + "2020 ";
            sourceData = sourceData.replace(tanggal, "");
            document.getElementById("demo2").value = sourceData;
            }
          }

        }
      }
    }
    document.getElementById("text_2").value = tanggal;
    let nomorUrut = 0;
    let dot_y = 0;
    let itemArray = [''];
    const sharp = "#";
  for (var jml_outlet = 0; jml_outlet <= 0; jml_outlet++) {
    for (var dot = 0; dot <= 50000; dot++) {
      dot_y = dot + 4;
      var string = sourceData.substring(dot, dot_y);
      dot_y = dot;
      if (string == "0604" || string == "0602" || string == "0603") {
        dot_x = dot + 9;
        var kd_outlet = sourceData.substring(dot, dot_x);
        document.getElementById("demo3").value = kd_outlet;
        // alert(kd_outlet);
      }else if (string == "FKML" || string == "FRML" ) {
        dot_x = dot + 18;
        var no_faktur = sourceData.substring(dot, dot_x);
        if (string == "FKML") {
          document.getElementById("demo4").value = no_faktur;
        }else if(string == "FRML"){
          document.getElementById("FRMLG").value = no_faktur;
        }
      }else if (string == "SBF-" || string == "CFL-" || string == "RBT-" || string == "RBI-") {
        dot_x = dot + 10;
        var item = sourceData.substring(dot, dot_x);
        // alert(item);
        document.getElementById("demo5").value = item;
        for (var counter = dot; counter <= 50000; counter++) {
          dot_y = counter + 4;
          var string_c = sourceData.substring(counter, dot_y);

          if (string_c == ".00\n") {
            xx = dot_y -1;
            for (var i = xx; i >= 0; i--) {
            xx = xx - 1;
            var cari = sourceData.substring(i, xx);

            for (var u = 0; u < 26; u++) {
                if (cari == " " || cari == alfabet[u]) {
                  counter = dot_y - 1;
                  var hrg_item = sourceData.substring(i, counter);
                  faktur = itemArray.push(document.getElementById("tanggal").innerHTML);
                  nomorUrut++;
                  document.getElementById("cobaan").value += sharp +hrg_item ;
                  document.getElementById("tanggal").innerHTML += kd_outlet +'&nbsp;'+ no_faktur +'&nbsp;'+ item +'&nbsp;'+ hrg_item + '<br>';
                  i=0;
                  counter = 50000;
                  u = 26;

                }
              }
            }
          }
        }
      }
    }
  }
    //copyintoTextarea = sourceData;
}
</script>
</form>
</body>
</html>