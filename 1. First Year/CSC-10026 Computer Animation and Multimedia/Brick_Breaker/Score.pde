//Write score to file
class Score
{
  PImage life = loadImage("lives.png");
  
  Score()
  {
    fill(255);
    textAlign(LEFT);
    text("Score: " + score, 5, height-30, width-5, height);
    life.resize(30,30);
    image(life, 0, 0);
  }
  
  //update score and lives
  void update()
  {
    fill(255);
    textAlign(LEFT);
    text("Score: " + score, 5, height-30, width-5, height);
    int fromRight = 30;
    for (int i = 0; i < lives; i++)
    {
      image(life, width-fromRight, height-30);
      fromRight+=30;
    }
  }
}