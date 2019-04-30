public class Workforce {

    private final Worker[] pool;  // The worker population.
    private int workerCount = 0;  // Used to generate each worker's ID and to keep a record of the number of workers in the workforce.

    Thread[] workerThreads;
            
    private final JobStack jobStack;  // Reference to the job stack.
    private final ResourceStack resourceStack;  // Reference to the resource stack.
    
    // Constructor.
    public Workforce(int size, JobStack theJobStack, ResourceStack theResourceStack) {
        jobStack = theJobStack;
        resourceStack = theResourceStack;

        pool = new Worker[size];
        for(int i=0; i<pool.length; i++) {
            pool[i] = new Worker(workerCount, jobStack, resourceStack);
            workerCount++;
        }

        workerThreads = new Thread[pool.length];
        for(int i=0; i<workerThreads.length; i++) {
            workerThreads[i] = new Thread(pool[i]);
        }
    }
    
    
    /// UNDER CONSTRUCTION /////////////////////////////////////////////////////
    
    
    // Starts all the worker threads.
    public void start() {
        //Loop to start all the threads
        for (int i = 0; i<pool.length; i++) {
            workerThreads[i].start();
        }
    }
    
    // Checks whether all workers have finished.
    public boolean allWorkersFinished() {
        boolean flag = true;    //Flag to determine whether all the workers have finished
        for (Worker pool1 : pool) {
            //Check each thread to see whether each worker has finished
            if (pool1.busy()) {
                flag = false;
            }
        }
        return flag;    //return the flag
    }

    // Prints the job record of all workers.
    public void printJobRecords() {
        if (allWorkersFinished()) {
            //Loop through each worker thread
            for (int i = 0; i<pool.length; i++) {
                int[] keys = new int[pool[i].getSetSize()]; //Initialize an array to store the job id's of all the jobs completed by the worker
                int index = 0;
                for (Integer j: pool[i].getKeys()) {
                    keys[index++] = j;  //Populate the keys array with the job id's
                }
                System.out.println("Worker " + i + ":");
                //Loop through all the jobs completed by the worker
                for (int j = 0; j < keys.length; j++) {
                    String values = pool[i].getValues().get(keys[j]).toString();    //Set the resource id's as a string
                    values = values.replace("[", "");
                    values = values.replace("]", "");
                    System.out.println("\tJob: " + keys[j] + ", Resources: " + values); //Output the job id with the id's of the resources used to complete it
                }
            }
        }
    }
}
