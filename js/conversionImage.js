

$('#inputTextAdmin').on('click', function() {

  if($('#inputTextAdmin').size()!=0){
      document.getElementById('inputTextAdmin').addEventListener('keyup', function (){
        convertAdmin();
      });
}
  });


function convertAdmin()
{
  var size=$('#inputTextAdmin').size();
  console.log(size);

  var textOnCanvas = new Kinetic.Text({
    x: 0,
    y: 0,
    fill: '#000000',
    width:400,
    fontFamily: "Arial",
    fontSize: 14,
    fill: '#000000',
    align: 'left',
    padding: 5,
    text: document.getElementById('inputTextAdmin').value
  });

  var twidth = textOnCanvas.getWidth();
  var theight = textOnCanvas.getHeight();

  var stage = new Kinetic.Stage({
      container: 'con',
      width:twidth,
      height:theight,
    });
  var layer = new Kinetic.Layer();



  layer.add(textOnCanvas);
  stage.add(layer);

  layer.draw();



};
