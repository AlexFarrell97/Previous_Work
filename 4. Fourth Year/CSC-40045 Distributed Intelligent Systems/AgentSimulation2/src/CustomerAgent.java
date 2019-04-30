public class CustomerAgent {
    
    int[] cust; //instance variable: customer constraints array
    
    public CustomerAgent() {
        cust = new int[] {product(), upperPrice(), quantity(), deliveryOption()}; //add all constraints to array
    }
    
    //select a random number to represent product requested
    public int product() {
        int product = (int)((Math.random() * 20) + 1);
        
        return product;
    }
    
    //select random number to represent upper price range
    public int upperPrice() {
        int upper = (int)((Math.random() * 100) + 1);
        
        return upper;
    }
    
    //select random number to represent quantity of product requested
    public int quantity() {
        int quant = (int)((Math.random() * 10) + 1);
        
        return quant;
    }
    
    //select random number to represent the delivery option required
    public int deliveryOption() {
        int option = (int)((Math.random() * 3) + 1);
        
        return option;
    }
    
    //select random number to represent the offer the customer will choose
    public int chooseOffer(int noOffers) {
        int offer = (int)((Math.random() * noOffers) + 1);
        
        return offer;
    }
}