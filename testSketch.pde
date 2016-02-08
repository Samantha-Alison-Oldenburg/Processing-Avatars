import processing.net.*; //<>// //<>// //<>// //<>// //<>// //<>//
int he = 48;
int wi = 48;
ArrayList parts;

void setup() {
  size(48,48);
  parts = new ArrayList();
}

void draw() {
  imageMode(CORNER);
  JSON_draw_avatar();


  //image(img, 10, 10, 50, 50);  // Draw image using CORNER mode
}

String readable_color(color c)
{
  int r, g, b, a;
  r = (c >> 16) & 0xFF;
  g = (c >> 8) & 0xFF;
  b = c & 0xFF;
  a = (c >> 24) & 0xFF;

  String output_str = str(r) + ", " + str(g)+ ", " + str(b)+ ", " + str(a);
  return output_str;
}
class AvatarPart{
  int xPos, yPos, W, H;
  String sImage;
  PImage part_img;
  AvatarPart(String sImage, int W, int H, int x, int y) {
    xPos = x;
    yPos = y;
    this.part_img = sLoadImage(sImage);
    this.W = W;
    this.H = H;
  }
  PImage sLoadImage(String path)
  {
    PImage img = loadImage(path);
    img.resize(W,H);
    return img;
  }
  void draw(){image(part_img, xPos, yPos, W, H);}
}

void JSON_draw_avatar(){
  background(200,200,255);
  for(int p=0, end=parts.size(); p<end; p++) {
  AvatarPart prt = (AvatarPart) parts.get(p);
 }}

  AvatarPart addPart(String sImage, int W, int H, int x, int y){
    AvatarPart prt = new AvatarPart(sImage, W, H, x, y);
    parts.add(prt);
    return prt;
  }
