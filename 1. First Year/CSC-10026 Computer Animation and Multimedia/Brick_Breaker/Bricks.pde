// Control the behaviour of the bricks
class Bricks
{
  float x; //brick x
  float y; //brick y
  float w; //brick width
  float h; //brick height
  
  int state; //brick state
  int r, g, b; //brick colour
  
  boolean dead; //brick dead or not
  
  Bricks(float x0, float y0)
  {
    x = x0;
    y = y0;
    
    w = 50;
    h = 25;
    
    state = (int)random(1, 4);
    brickState(state);
  }
  
  void update()
  {
    if (dead == true)
    {
      noStroke();
      fill(0,0,0);
    } else {
      stroke(r, g, b);
      fill(r, g, b);
    }
    rect(x, y, w, h);
  }
  
  //set the colour of the brick
  void brickState(int state)
  {
    switch(state)
    {
      case 0:
        r = 0;
        g = 0;
        b = 0;
        bkRemain-=1;
        dead = true;
        //decice whether to implement special ability
        float random = random(1,7);
        println((int)random);
        if ((int)random == 6)
        {
          sp.paddleSize();
        }
      
      case 1:
        r = 0;
        g = 255;
        b = 0;
        break;
      
      case 2:
        r = 255;
        g = 255;
        b = 0;
        break;
        
      case 3:
        r = 255;
        g = 0;
        b = 0;
    }
  }
  
  //handle behaviour when brick is hit
  void brickHit()
  {
    state-=1;
    if(bkRemain>0)score+=1;
    brickState(state);
  }
}