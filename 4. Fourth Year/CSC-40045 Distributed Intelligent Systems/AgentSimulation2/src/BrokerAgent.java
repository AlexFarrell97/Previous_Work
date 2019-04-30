import java.util.ArrayList;
import java.util.List;

public class BrokerAgent {
    
    public static void main(String[] args) {
        List<int[][]> retailers = new ArrayList<int[][]>(); //store a list of retailers
        List<int[][]> invites = new ArrayList<int[][]>(); //store a list of invites to retailers
        List<int[][]> priceList = new ArrayList<int[][]>(); //store a list of retailers who fit the max price
        List<int[][]> quantityList = new ArrayList<int[][]>(); //store a list of retailers who have the desired quantity
        List<int[][]> productOffers = new ArrayList<int[][]>(); //store a list of retailers who satisy all constraints
        
        int noRetailers = 10; //number of retailers
        
        //create desired number of instances of retailer agent
        for (int i = 0; i < noRetailers; i++) {
            RetailerAgent retailer = new RetailerAgent();
            retailers.add(retailer.stock); //add retailer instance stockk information to List
        }
        
        CustomerAgent customer1 = new CustomerAgent(); //create an instance of customer agent
        
        int[] customer = customer1.cust; //store customer request in array
        System.out.println("Your Request:");
        System.out.println("\tProduct: " + customer[0]);
        System.out.println("\tMax Price: £" + customer[1]);
        System.out.println("\tQuantity Required: " + customer[2]);
        System.out.println("\tDelivery Option: " + customer[3] + "\n");
        
        int noInvites = 0;
        //check the number of retailers who stock the requested product
        for (int i = 0; i < noRetailers; i++) {
            if (checkProduct(retailers.get(i), customer)) {
                invites.add(retailers.get(i)); //add retailer to list of invites
                noInvites++;
            }
        }
        
        int noPrice = 0;
        //check the price of the product for each invited retailer
        for (int i = 0; i < noInvites; i++) {
            if (!checkPrice(invites.get(i), customer)) {
                priceList.add(invites.get(i));
                noPrice++;
            }
        }
        
        int noQuantity = 0;
        //check quantity of product at each invited retailer
        for (int i = 0; i < noPrice; i++) {
            if (checkQuantity(priceList.get(i), customer)) {
                quantityList.add(priceList.get(i));
                noQuantity++;
            }
        }
        
        int noOffers = 0;
        //check delivery type for product at each invited retailer
        for (int i = 0; i < noQuantity; i++) {
            if (checkDelivery(quantityList.get(i), customer)) {
                productOffers.add(quantityList.get(i));
                noOffers++;
            }
        }
        
        if(noOffers == 0) {
            System.out.println("Your product request returned no offers"); //output error message if no offers are received
        } else {
            System.out.println("You have received " + noOffers + " offers\n"); //output number of offers received
            for(int i = 0; i < noOffers; i++) {
                int[][] retailer = productOffers.get(i); //get stock info of offered retailer
                int[] offer = new int[retailer[0].length];
                //add product info at retailer to an individual offer array
                for(int j = 0; j < retailer.length; j++) {
                    if(customer[0] == retailer[j][0]) {
                        for(int a = 0; a < offer.length; a++) {
                            offer[a] = retailer[j][a];
                        }
                    }
                }
                //output offer details
                System.out.println("Retailer " + (i+1) + ":");
                System.out.println("\tUnit Price: £" + offer[1]);
                System.out.println("\tQuantity Available: " + offer[2]);
                System.out.println("\tDelivery Option: " + offer[3]);
            }
            int choice = customer1.chooseOffer(noOffers); //select choice of offer
            System.out.println("\nYou have chosen to purchase from Retailer " + choice); //output offer choice
        }
    }
    
    //check the product is stocked by a retailer
    static boolean checkProduct(int[][] retailer, int[] customer) {
        boolean found = false;
        
        for (int i = 0; i < retailer.length; i++) {
            if (customer[0] == retailer[i][0]) {
                found = true;
            }
        }
        
        return found;
    }
    
    //check price of product at retailer is less than or equal to the max price
    static boolean checkPrice(int[][] retailer, int[] customer) {
        boolean price = false;
        
        for (int i = 0; i < retailer.length; i++) {
            if (customer[0] == retailer[i][0]) {
                if (customer[1] <= retailer[i][1]) {
                    price = true;
                }
            }
        }
        
        return price;
    }
    
    //check a retailer has desired quantity of a product
    static boolean checkQuantity(int[][] retailer, int[] customer) {
        boolean quantity = false;
        
        for (int i = 0; i < retailer.length; i++) {
            if (customer[0] == retailer[i][0]) {
                if (customer[2] <= retailer[i][2]) {
                    quantity = true;
                }
            }
        }
        
        return quantity;
    }
    
    //check retailer offers desired delivery type for a product
    static boolean checkDelivery(int[][] retailer, int[] customer) {
        boolean delivery = false;
        
        for (int i = 0; i < retailer.length; i++) {
            if (customer[0] == retailer[i][0]) {
                if (customer[2] == retailer[i][2] || retailer[i][2] == 0) {
                    delivery = true;
                }
            }
        }
        
        return delivery;
    }
}