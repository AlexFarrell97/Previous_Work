/*  Interface Definition for a simple priority queue using integer
    values to represent priority  
    Charles Day
    June 2008
*/

public interface PriorityQueueInterface
{
 
  public boolean isFull();
    /* post: if the size of the queue has not reached its upper bound,
             then returns false, else returns true */

  public boolean isEmpty();
    /* post: if the queue has no elements returns true, else false */

  public void enQueue(int element);
    /* pre:  the size of the queue has not reached an upper bound
       post: the queue includes the new element in a position before
             any elements of lower priority and behind any of higher
             priority */

  public int Serve();
    /* pre:  the queue is not empty
       post: the first (highest priority) element is returned and that
             element is removed from the queue, with its successor
             element (if any) being the element of next highest priority */

  public int getHead();
    /* pre:  the queue is not empty
       post: the value of the element at the head of the queue is
             returned, and the queue is unchanged   */

  public int queueLength();
    /* post: current number of data items in the queue is returned */

  public int queueSize();
    /* post: the size of the queue's array is returned */

} // end PriorityQueueInterface
