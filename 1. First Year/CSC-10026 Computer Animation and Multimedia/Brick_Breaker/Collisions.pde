// Control the behaviours after collisions
class Collisions
{
  void collision()
  {
    //Ball hits left of paddle
    if(bl.y >= pd.y && bl.x >= pd.x && bl.x <= pd.x + (pd.w/2))
    {
      bl.moveLeft();
      bl.vy=(abs(bl.vy))*-1;
    }
    
    //Ball hits right of paddle
    if (bl.y >= pd.y && bl.x >= pd.x + (pd.w/2) && bl.x <= pd.x + pd.w)
    {
      bl.moveRight();
      bl.vy=(abs(bl.vy))*-1;
    }
    
    //Ball hits left wall
    if(bl.x-bl.d/2 <= 0)
    {
      bl.moveRight();
    }
    
    //Ball hits right wall
    if(bl.x+bl.d/2 >= width)
    {
      bl.moveLeft();
    }
    
    //Ball hits top wall
    if(bl.y-bl.d/2 <= 0)
    {
      bl.changeY();
    }
    
    //Ball hits bottom wall
    if(bl.y-bl.d/2 >= height)
    {
      lives-=1;
      bl.reset();
      pd.w = 100;
    }
    
    
    for(int i = 0; i < total; i++)
    {
      //Ball hits bottom of brick
      if(bl.y - bl.d / 2 <= bk[i].y + bk[i].h &&  bl.y - bl.d/2 >= bk[i].y && bl.x >= bk[i].x && bl.x <= bk[i].x + bk[i].w  && bk[i].dead == false)
      {
        bl.changeY();
        bk[i].brickHit();
      }
      
      //Ball hits top of brick
      if (bl.y + bl.d/2 >= bk[i].y && bl.y - bl.d /2 <= bk[i].y + bk[i].h/2 && bl.x >= bk[i].x && bl.x <= bk[i].x + bk[i].w && bk[i].dead == false)
      {
        bl.changeY();
        bk[i].brickHit();
      }
      
      //Ball hits left of brick
      if (bl.x + bl.d/2 >= bk[i].x && bl.x + bl.d/2 <= bk[i].x + bk[i].w/2 && bl.y >= bk[i].y && bl.y <= bk[i].y + bk[i].h  && bk[i].dead == false)
      {
        bl.moveRight();
        bk[i].brickHit();
      }
      
      //Ball hits right of brick
      if (bl.x - bl.d/2 <= bk[i].x + bk[i].w && bl.x +bl.d/2 >= bk[i].x + bk[i].w/2 && bl.y >= bk[i].y && bl.y <= bk[i].y + bk[i].h  && bk[i].dead == false)
      {
        bl.moveRight();
        bk[i].brickHit();
      }
      
    }
    
  }
}