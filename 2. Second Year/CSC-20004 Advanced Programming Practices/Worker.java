import java.util.ArrayList;
import java.util.Map;
import java.util.Set;
import java.util.TreeMap;

public class Worker implements Runnable {

    private final int id;  // Unique worker ID.
    
    private final JobStack jobStack;  // Reference to the job stack.
    private final ResourceStack resourceStack;  // Reference to the resource stack.
    
    private Job job;  // Job being processed.
    private Resource[] resources;  // Resources being used for job being processed.
    
    private boolean busy;  // Indicates the status of the worker. True when they are working (executing jobs) and false when there are no more jobs left to execute.
    
    private final Map<Integer, ArrayList<Integer>> jobsCompleted;  // The job record of the worker. Stores each job's ID and the IDs of the resources used for each job.
    
    // Constructor.
    public Worker(int theId, JobStack theJobStack, ResourceStack theResourceStack) {
        id = theId;
        jobStack = theJobStack;
        resourceStack = theResourceStack;
        job = null;
        busy = true;
        jobsCompleted = new TreeMap<>();
    }

    
    /// UNDER CONSTRUCTION /////////////////////////////////////////////////////
    
    
    @Override
    public void run() {
        System.out.println("Worker " + id + " started");
        //Loop until the job stack is empty
        do {
            busy = true;    //Set the busy variable to true when the worker starts a job
            job = jobStack.pop();   //Aquire a job from the job stack
            resources = resourceStack.pop(job.getResourceRequirement());    //Aquire the resources required for the job
            try {
                Thread.sleep(job.getTimeToComplete());  //Pause the program for the required time for the job
            } catch (InterruptedException e) {
                System.out.println("There was an Interrupt execption on the job: " + job.getId() + " - " + e);
            }

            ArrayList<Integer> resourcesUsed = new ArrayList<> ();  //Initialize an array to store the resources used for this job
            for (Resource resource : resources) {
                resourcesUsed.add(resource.getId());    //Add the resources used to the resourcesUsed array list
            }
            resourceStack.push(resources);  //Return the resources to the stack
            jobsCompleted.put(job.getId(), resourcesUsed);  //Add the job to the job record for the worker
            System.out.println("Worker " + id + " completed job " + job.getId());   //Print out the job the worker has completed
            busy = false;   //Set the busy variable to false when the worker finishes a job
        } while (jobStack.getSize() > 0);
        System.out.println("Worker " + id + " has finished");
    }
    
    //Method to return the value of the busy variable to the Workforce class
    public boolean busy() {
        return busy;
    }
    
    //Method to return the job id's in a set to the Workforce class
    public Set<Integer> getKeys() {
        return jobsCompleted.keySet();
    }
    
    //Method to return the number of jobs a worker has completed to the Workforce class
    public int getSetSize() {
        return getKeys().size();
    }
    
    
    //Method to return the job record of a worker to the Workforce class
    public Map<Integer, ArrayList<Integer>> getValues() {
        return jobsCompleted;
    }
    
}
