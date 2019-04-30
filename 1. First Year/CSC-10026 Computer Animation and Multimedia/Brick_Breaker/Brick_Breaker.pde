//ALEX FARRELL (W4S22)
//CSC-10026, YEAR 1 (SEMESTER 2)
//KEELE UNIVERSITY SCHOOL OF COMPUTING AND MATHEMATICS
//BRICK BREAKER GAME

//INSTRUCTIONS
  //Move the paddle using the mouse to bounce the ball to destroy the bricks
  //If the ball hits the bottom of the screen, you lose a life
  //The game ends when either all lives are lost or all bricks are destroyed


PFont font;

Ball bl;
Bricks[] bk;
Collisions cl;
Paddle pd;
Score sc;
Specials sp;

int rows = 9;
int columns = 5;
int total = rows * columns;
int bkRemain = total;
int bkx = 60, bky = 60;
int lives = 3;
int score = 0;

void setup()
{
  size(600, 600);
  background(0);
  smooth();
  //load the font
  font = loadFont("CourierNewPS-BoldMT-48.vlw");
  textFont (font, 25);
  //initialize the classes
  bl = new Ball();
  bk = new Bricks[total];
  cl = new Collisions();
  pd = new Paddle();
  sc = new Score();
  sp = new Specials();
  
  drawBricks();
}

void draw()
{
  background(0);
  smooth();
  play();
}

void play()
{
  sc.update();
  cl.collision();
  for (int i = 0; i < total; i++)
  {
    bk[i].update();
  }
  pd.update();
  bl.update();
  if (lives == 0)
  {
    bl.vy = 0;
    lose();
  } else if (bkRemain == 0)
  {
    bl.vy = 0;
    win();
  }
}

//Draw the bricks on the screen
void drawBricks()
{
  int t = 0;
  
  for (int i = 0; i < rows; i++)
  {
    for (int j = 0; j < columns; j++)
    {
      bk[t] = new Bricks((i+1) *width/(rows + 2), (j+1)*30);
      t++;
    }
  }
}

void lose()
{
  background(0);
  textAlign(CENTER, CENTER);
  text("You Lose!", 0, 0, width, height-50);
  text("Final score: " + score, 0, 0, width, height);
  text("Press SPACE to play again", 0, 0, width, height+100);
  text("Or ESC to exit", 0, 0, width, height+150);
  //key to restart game
  if(keyPressed == true)
  {
    if(key == ' ')
    {
       resetGame();
    }
    if(key == ESC)
    {
      exit();
    }
  }
}

void win()
{
  background(0);
  textAlign(CENTER, CENTER);
  text("You Win!", 0, 0, width, height-50);
  text("Final score: " + score, 0, 0, width, height);
  text("Press SPACE to play again", 0, 0, width, height+100);
  text("Or ESC to exit", 0, 0, width, height+150);
  //key to restart game
  if(keyPressed == true)
  {
    if(key == ' ')
    {
       resetGame();
    }
    if(key == ESC)
    {
      exit();
    }
  }
}

//Resets the game
void resetGame()
{
  keyPressed = false;
  //reset all values
  score = 0;
  lives = 3;
  bkRemain = total;
  
  //reset methods
  drawBricks();
  bl.reset();
  play();
}