/* Example of creating own exceptions for ADT */

import java.lang.RuntimeException;

class QueueBoundaryException extends RuntimeException {
    
  public QueueBoundaryException(String message) {
    super(message);
  } // end constructor
  
} // end QueueBoundaryException
