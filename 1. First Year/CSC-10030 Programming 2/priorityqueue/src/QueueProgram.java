/* A simple test program to exercise the PriorityQueue ADT */

public class QueueProgram
{

    public static void main ( String[] args )
    {
        int queuesize = 3;
        // create an instance of this program and a PriorityQueue
        QueueProgram myProgObj = new QueueProgram();
        //ArrayPriorityQueue takes the size of the queue as an arguement in its constructor
        ArrayPriorityQueue queue1 = new ArrayPriorityQueue(queuesize);

        // get the program object to do some tests
        myProgObj.runTests(queue1);

    } // end main

    public void runTests(ArrayPriorityQueue testQ) {
        //When you run this code, you will get a compile time error due to one of the nature of one of the tests.
        //Please choose 'run anyway' as this error is handled within the code.
        int value = 0;
        
        // Test 1.1 - Testing whether the queuesize variable has been passed into the ArrayPriorityQueue method correctly.
        System.out.print("TEST NUMBER 1.1  | ");
        System.out.println("Queue Size: " + testQ.queueSize());

        // Test 1.2 - Testing whether when the queue has not been enQueued any elements, the queue is empty.
        System.out.print("TEST NUMBER 1.2  | ");
        System.out.println("isEmpty(): " + testQ.isEmpty());

        // Test 1.3 - Testing whether an attempt at trying to add an element of another primitive data type, throws an exception.
        System.out.print("TEST NUMBER 1.3  | ");

        try {
            testQ.enQueue(2.5); // Add the element 2.5 to the queue
            System.out.println("The element " + testQ.getHead() + " was added to the queue.");
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }

        // Test 1.4 - Testing that an attempt at trying to add an element of data type ‘int’ doesn’t throw an exception.
        System.out.print("TEST NUMBER 1.4  | ");

        try {
            value = 5;
            testQ.enQueue(value); // Add the element 5 to the queue
            System.out.println("The element " + value + " was added to the queue.");
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }

        // Test 1.5 - Testing that now the queue should contain elements, the queue is not empty.
        System.out.print("TEST NUMBER 1.5  | ");
        System.out.println("isEmpty(): " + testQ.isEmpty());

        // Test 1.6 - Testing that now the queue should contain elements, the queue length is not ‘0’.
        System.out.print("TEST NUMBER 1.6  | ");
        System.out.println("Queue Length: " + testQ.queueLength());

        // Test 1.7 - Testing that because the queue length is smaller than the queue size, the queue is not full.
        System.out.print("TEST NUMBER 1.7  | ");
        System.out.println("isFull(): " + testQ.isFull());
        
        // Test 1.8 - Testing that when the head of a queue which contains elements is requested, the correct head value is returned.
        System.out.print("TEST NUMBER 1.8  | ");
        System.out.println("getHead(): " + testQ.getHead());
        
        // Test 1.9 - Testing that when an element is added to the queue, the priority aspect of the queue, puts the elements in the correct places.
        System.out.print("TEST NUMBER 1.9a | ");
        
        try {
            value = 3;
            testQ.enQueue(value); // Add the element 3 to the queue
            System.out.println("Element '" + value + "' added. Head of queue: " + testQ.getHead());
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }
        
        System.out.print("TEST NUMBER 1.9b | ");
        
        try {
            value = 8;
            testQ.enQueue(value); // Add the element 8 to the queue
            System.out.println("Element '" + value + "' added. Head of queue: " + testQ.getHead());
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }
        
        // Test 1.10 - Testing that when the getHead() method is called, the queue remains unchanged.
        System.out.print("TEST NUMBER 1.10 | ");
        System.out.println("getHead(): " + testQ.getHead());
        
        //Test 1.11 - Testing that now the queue length should be the same as the queue size, the queue is full.
        System.out.print("TEST NUMBER 1.11 | ");
        System.out.println("isFull(): " + testQ.isFull());
        
        // Test 1.12 - Testing that now the queue should be full, when an attempt is made to add an element, an exception is thrown.
        System.out.print("TEST NUMBER 1.12 | ");

        try {
            value = 2;
            testQ.enQueue(value); // Add the element 2 to the queue
            System.out.println("The element '" + value + "' was added to the queue.");
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }
        
        // Test 1.13 - Testing that when an attempt is made to serve an element from a queue containing data, an exception is not thrown.
        System.out.print("TEST NUMBER 1.13 | ");

        try {
            value = testQ.getHead();
            testQ.Serve(); // Head element removed from queue
            System.out.println("The element '" + value + "' was removed from the queue.");
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }
        
        // Test 1.14 - Testing that now an element has been removed from the queue, the queue length has decreased.
        System.out.print("TEST NUMBER 1.14 | ");
        System.out.println("Queue Length: " + testQ.queueLength());
        
        // Test 1.15 - Testing that when an attempt is made to serve an empty queue, an exception is thrown.
        
        // Empty the queue
        while(true) {
            try {
                testQ.Serve(); // Head element removed from queue
            } catch (RuntimeException re) {
                break;
            }
        }
        
        System.out.print("TEST NUMBER 1.15 | ");

        try {
            value = testQ.getHead();
            testQ.Serve(); // Head element removed from queue
            System.out.println("The element '" + value + "' was removed from the queue.");
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }
        
        // Test 1.16 - Testing that when the head of a queue which is empty is requested, the value returned is null.
        System.out.print("TEST NUMBER 1.16 | ");
        System.out.print("getHead(): " + testQ.getHead());
        System.out.println(", Queue Length: " + testQ.queueLength());
        
        // Test 1.17 - When an element smaller than the apparent head is added, is this value overwritten?
        System.out.print("TEST NUMBER 1.17 | ");
        
        try {
            value = 2;
            testQ.enQueue(value); // Add the element 2 to the queue
            System.out.println("Element '" + value + "' was added. Head of Queue: " + testQ.getHead());
        } catch (RuntimeException re) {
            System.out.println(re.getMessage());
        }

    }
  
} // end class QueueProgram1

/* 
1.16 getHead no
*/