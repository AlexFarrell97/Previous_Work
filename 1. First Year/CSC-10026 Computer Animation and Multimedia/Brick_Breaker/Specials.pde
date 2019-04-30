// Control the behaviour of the special items
class Specials
{  
  //Bigger/smaller paddle
  void paddleSize()
  {
    float random = random(1,4);
    
    switch((int)random)
    {
      case 1:
        pd.w = 50;
        break;
      case 2:
        pd.w = 100;
        break;
      case 3:
        pd.w = 150;
    }
  }
}