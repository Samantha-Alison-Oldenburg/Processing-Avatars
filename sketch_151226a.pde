import processing.net.*; //<>// //<>// //<>// //<>// //<>// //<>//
int he = 598;
int wi = 598;
Avatar avatar;
/*void settings() //<>//
{
  size(wi, he);
}*/
void setup() {
  args = null;
  if (args != null)
    size(wi, he);
  else
    size(wi,he);
  background(0, 0, 0);
    Avatar_Parameters ap;
    int[] params;
  //args is the variable that holds the parameters of the program
 if (args != null && args.length == 15)
  {

    params = new int[15];
    for (int i = 0; i < 15; i++)
    {
      params[i] =args[i];
    }
  }

  else
  {
    params = new int[]{ 0, //x position
    0, //y position
    wi, //width
    he, //height
    6, //eyes
    6, //eyebrows
    4, //mouth
    2, //eyelash
    1, //beaker color
    //for the rest of the parameters, 0 means false
    0, //bubbles
    0, //bowtie/buttondown
    0, //is the beaker half empty
    0, //is the beaker brimming with ideas
    0, //does the beaker have mad scientist hair
    0}; //does the beaker have a mustache
  }


    ap = new Avatar_Parameters(params);
    avatar = new Avatar(ap);


}

void draw() {
  imageMode(CORNER);
  avatar.draw_avatar();


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
class Avatar_Parameters
{
  int x,
    y,
    w,
    h,
    eyes,
    eyebrows,
    eyelash,
    mouth,
    color_index,
    bubbles,
    bowtie,
    half_empty,
    brimming_with_ideas,
    hair,
    mustache;

    Avatar_Parameters(int[] parameters)
    {
      x = parameters[0];
      y = parameters[1];
      w = parameters[2];
      h = parameters[3];
      eyes = parameters[4];
      eyebrows = parameters[5];
      eyelash = parameters[6];
      mouth = parameters[7];
      color_index = parameters[8];
      bubbles = parameters[9];
      bowtie = parameters[10];
      half_empty = parameters[11];
      brimming_with_ideas = parameters[12];
      hair= parameters[13];
      mustache= parameters[14];
    }
}
class Avatar
{
  Avatar_Parameters A_P;

  PImage background_img;
  PImage Eyes_img;
  PImage Eyebrows_img;
  PImage Eyelash_img;
  PImage Mouth_img;
  PImage BeakerHalfEmpty_img;
  PImage BeakerContents_img;
  PImage Bowtie_img;
  PImage Bubbles_img;
  PImage BrimmingWithIdeas_img;
  PImage Hair_img;
  PImage Mustache_img;

  int W, H, X, Y;

  boolean has_bubbles, has_bowtie, is_half_empty, is_brimming_with_ideas, has_hair, has_mustache;
  color fluid_color;



  String get_pathname(String feature, int index)
  {
    String pathname = feature + "/" + feature + str(index) + ".png";
    return pathname;
  }


  PImage sLoadImage(String path)
  {
    PImage img = loadImage(path);
    img.resize(W,H);
    return img;
  }

  Avatar(Avatar_Parameters ap)
  {
    A_P = ap;
    W = A_P.w;
    H = A_P.h;

    background_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/Base.png");
    BeakerContents_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" + get_pathname("Color", A_P.color_index));
    Eyes_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" + get_pathname("Eyes", A_P.eyes));
    Eyebrows_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +get_pathname("Eyebrows", A_P.eyebrows));
    Eyelash_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +get_pathname("Eyelash", A_P.eyelash));
    Mouth_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +get_pathname("Mouth", A_P.mouth));


    has_bubbles =  (A_P.bubbles != 0);
    if (has_bubbles)
      Bubbles_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"Bubbles.png");


    has_bowtie = (A_P.bowtie != 0);
    if (has_bowtie)
      if (A_P.bowtie == 1)
        Bowtie_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"Bowtie.png");
      else if (A_P.bowtie == 2)
        Bowtie_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"ButtonDown.png");

    is_half_empty = (A_P.half_empty != 0);
    if (is_half_empty)
      BeakerHalfEmpty_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"BeakerHalfEmpty.png");


    is_brimming_with_ideas = (A_P.brimming_with_ideas != 0);
    if (is_brimming_with_ideas)
      BrimmingWithIdeas_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"Brimming_With_Ideas.png");

    has_hair = (A_P.hair != 0);
    if (has_hair)
      Hair_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"MadSciHair.png");

    has_mustache = (A_P.mustache != 0);
    if (has_mustache)
      Mustache_img = sLoadImage("http://www.scigamescrew.com/staging/wp-content/plugins/processing-avatars/sketch_151226a/data/" +"Mustache.png");

  }

  void draw_avatar()
  {
    image(BeakerContents_img, X, Y, W, H);
    if (is_half_empty)
      image(BeakerHalfEmpty_img, X, Y, W, H);
    image(background_img, X, Y, W, H);

    image(Eyes_img, X, Y, W, H);
    image(Eyebrows_img, X, Y, W, H);
    image(Mouth_img, X, Y, W, H);
    image(Eyelash_img, X, Y, W, H);


    if (has_bubbles)
      image(Bubbles_img, X, Y, W, H);



    if (has_bowtie)
      image(Bowtie_img , X, Y, W, H);



    if (is_brimming_with_ideas)
      image(BrimmingWithIdeas_img, X, Y, W, H);

    if (has_hair)
      image(Hair_img, X, Y, W, H);

    if (has_mustache)
      image(Mustache_img, X, Y, W, H);
    fill(fluid_color);
    //rect(0,0,598,598);

  }
}
